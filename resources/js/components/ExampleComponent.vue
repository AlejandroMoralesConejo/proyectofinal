<template>
    <div class="row">
        <table class="table table-striped table-light">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Jugadores apuntados</th>
                    <th scope="col">Pista</th>
                    <th scope="col">#</th>
                </tr>
            </thead>
            <tbody>
                
                <tr v-for="match in arrayMatches" :key="match.idPartido"> <!--Recorremos el array y cargamos nuestra tabla-->
                    <td v-text="match.nombre"></td>
                    <td v-text="match.fecha"></td>
                    <td v-text="match.hora"></td>
                    <td v-text="match.limite"></td>
                    <td v-text="match.nombreP"></td>
                    <td>

                        <!-- Modify -->
                        <b-button v-b-modal.modal-1 @click="loadFieldsUpdate(match)">Modificar</b-button>
                        <b-modal id="modal-1" title="Editar partido" ok-title="Modificar" ok-variant="success" cancel-title="Cancelar" @ok="updateMatch()">
                            <div class="form-group"><!-- Formulario para la creación o modificación de nuestras tareas-->
                                <label>Nombre</label>
                                <input v-model="nombre" type="text" class="form-control">

                                <label>Fecha</label>
                                <input v-model="fecha" type="date" class="form-control">

                                <label>Hora</label>
                                <input v-model="hora" type="time" class="form-control">

                                <select v-model="idPista">
                                    <option v-if="update == 0" disabled value="">Seleccione una pista</option>
                                    <!-- <option v-for="pista in pistas" v-bind:value="pista.idPista" >{{ pista.nombreP }}</option>-->
                                </select>
                            </div>
                        </b-modal>

                        
                        <b-button color="error" v-b-modal.modal-2>Borrar</b-button>
                        <b-modal ok-title="Borrar" ok-variant="danger" cancel-title="Cancelar" @ok="deleteMatch(match)" id="modal-2" title="¿Estas seguro?">

                        </b-modal>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

                    <!-- Botón que añade los datos del formulario, solo se muestra si la variable update es igual a 0-->
                    <!-- <button v-if="update == 0" @click="saveTasks()" class="btn btn-success">Añadir</button> -->
                    <!-- Botón que modifica la tarea que anteriormente hemos seleccionado, solo se muestra si la variable update es diferente a 0-->
                    <!-- <button v-if="update != 0" @click="updateTasks()" class="btn btn-warning">Actualizar</button> -->
                    <!-- Botón que limpia el formulario y inicializa la variable a 0, solo se muestra si la variable update es diferente a 0-->
                    <!-- <button v-if="update != 0" @click="clearFields()" class="btn">Atrás</button> -->
</template>

<script>
    export default {
        data(){
            return{
                idPista:"",
                nombre:"", //Esta variable, mediante v-model esta relacionada con el input del formulario
                fecha:"", //Esta variable, mediante v-model esta relacionada con el input del formulario
                hora:"", //Esta variable, mediante v-model esta relacionada con el input del formulario
                limite:0, /*Esta variable contrarolará cuando es una nueva tarea o una modificación, si es 0 significará que no hemos seleccionado ninguna tarea, pero si es diferente de 0 entonces tendrá el id de la tarea y no mostrará el boton guardar sino el modificar*/
                nombreP:"",
                arrayMatches:[], //Este array contendrá las tareas de nuestra bd
                pistas:[],
            }
        },
        methods:{
            getMatches(){
                // me.getPistas();
                let me =this;
                let url = '/admin/partidos' //Ruta que hemos creado para que nos devuelva todas las tareas
                axios.get(url).then(function (response) {
                    //creamos un array y guardamos el contenido que nos devuelve el response
                    me.arrayMatches = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            getPistas(){
                let me =this;
                let url = '/admin/pistas' //Ruta que hemos creado para que nos devuelva todas las tareas
                axios.get(url).then(function (response) {
                    //creamos un array y guardamos el contenido que nos devuelve el response
                    me.pistas = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            saveMatch(){
                let me =this;
                let url = '/admin/add' //Ruta que hemos creado para enviar una tarea y guardarla
                axios.post(url,{ //estas variables son las que enviaremos para que crear la tarea
                    'nombre':this.nombre,
                    'fecha':this.fecha,
                    'hora':this.hora,
                    'idPista':this.idPista,
                }).then(function (response) {
                    me.getMatches();//llamamos al metodo getTask(); para que refresque nuestro array y muestro los nuevos datos
                    me.clearFields();//Limpiamos los campos e inicializamos la variable update a 0
                })
                .catch(function (error) {
                    console.log(error);
                });   
                
            },
            updateMatch(){/*Esta funcion, es igual que la anterior, solo que tambien envia la variable update que contiene el id de la
                tarea que queremos modificar*/
                let me = this;
                axios.put('/admin/update',{
                    'idPartido':this.update,
                    'nombre':this.nombre,
                    'fecha':this.fecha,
                    'hora':this.hora,
                    'idPista':this.idPista,
                }).then(function (response) {
                   me.getMatches();//llamamos al metodo getTask(); para que refresque nuestro array y muestro los nuevos datos
                   me.clearFields();//Limpiamos los campos e inicializamos la variable update a 0
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadFieldsUpdate(data){ //Esta función rellena los campos y la variable update, con la tarea que queremos modificar
                this.update = data.idPartido
                let me =this;
                let url = '/admin/find/'+this.update;
                axios.get(url).then(function (response) {
                    me.nombre= response.data.nombre;
                    me.fecha= response.data.fecha;
                    me.hora= response.data.hora;
                    me.idPista= response.data.nombreP;
                    
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                }); 
            },
            deleteMatch(data){//Esta nos abrirá un alert de javascript y si aceptamos borrará la tarea que hemos elegido
                let me =this;
                let task_id = data.idPartido
                // if (confirm('¿Seguro que deseas borrar este partido?')) {
                axios.delete('/admin/delete/'+task_id
                ).then(function (response) {
                    me.getMatches();
                })
                .catch(function (error) {
                    console.log(error);
                }); 
                // }
            },
            clearFields(){/*Limpia los campos e inicializa la variable update a 0*/
                this.nombre = "";
                this.fecha = "";
                this.hora = "";
                this.idPista = "";
                this.update = 0;
            }
        },
        mounted() {
           this.getMatches();
           this.getPistas();
        }
    }
</script>
