<template>
    <div id="app">
        <tasks :tasks="tasks"></tasks>
    </div>
</template>

<script>
    import Tasks from './components/Tasks.vue'
    import axios from 'axios'

    export default {
        name: 'app',
        data() {
            return {
                tasks: []
            }
        },
        components: {
            'tasks': Tasks,
        },
        created() {
            console.log('Component App ha estat creat')
            // AJAX -> Asynchonous Javascript And XML
            // XHR -> XML/JSON HTTP Request -> Asíncrones
            // this.tasks =

            // JAVASCRIPT NO BLOQUEJA
            // axios.get('http://localhost:8050/api/v1/tasks')
            // console.log('Prova');

            axios.get('http://localhost:8050/api/v1/tasks').then((response)=>{
            // axios.get('https://httpbin.org/get').then(()=>{
                    console.log('TOT HA ANAT BÉ');
                    this.tasks = response.data
                }).catch((error)=>{
                console.log('CONNECTION ERROR');
            })

            // 3 opcions
            //     1) CALLBACKS -> Funcions anònimes
            //         fileManager.open('/home/sergi/.bashrc', (file) => {
            //             console.log(file);
            //         })
            //     2) PROMISES then.catch
            //         axios.get('http://localhost:8050/api/v1/tasks').then(
            //             'TOT OK'
            //         ).catch(
            //             'ERROR'
            //         )
            //     3) ASYNC WAIT
            //         let result = await axios.get('http://localhost:8050/api/v1/tasks') faltaría posar async davant la funció

            // 3 opcions
            //     1) API per defecte de javascript
            //     2) Jquery
            //     3) Llibreries específiques -> Axios
        }
    }
</script>

<style>

</style>
