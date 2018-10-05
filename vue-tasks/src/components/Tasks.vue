<template>
    <div class="container flex justify-center">
        <div class="flex flex-col">
            <h1 class="text-center text-red-light pb-3 pt-8">Tasques ({{total}})</h1>
            <div class="flex-row">
                <input type="text" v-model="newTask" @keyup.enter="add" placeholder="Nova Tasca"
                       class="m-3 mt-5 p-2 pl-5 shadow border rounded focus:outline-none focus:shadow-outline text-grey-darker">
                <!--<button @click="add">Afegir</button>-->
                <svg @click="add" class="h-4 w-4 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/>
                </svg>
            </div>
            <!--<input :value="newTask" @input="newTask = $event.target.value">-->
            <ul class="list-reset">
                <!--<li v-for="task in tasks" v-if="task.completed"><strike>{{task.name}}</strike></li>-->
                <!--<li v-else>{{task.name}}</li>-->
                <li v-for="task in filteredTasks" :key="task.id" class="text-grey-darker m-2 pl-5">
                    <span :class="{strike:task.completed}">{{task.name}}</span>
                    &nbsp;
                    <span @click="remove(task)" class="cursor-pointer">&#215;</span>
                </li>
            </ul>
            <h3>Filtros</h3>
            Active filter: {{filter}}
            <ul class="list-reset">
                <li>
                    <button @click="setFilter('all')">Totes</button>
                </li>
                <li>
                    <button @click="setFilter('completed')">Completades</button>
                </li>
                <li>
                    <button @click="setFilter('active')">Pendents</button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>

    var filters = {
        all: function (tasks) {
            return tasks
        },
        completed: function (tasks) {
            return tasks.filter(function (task) {
                return task.completed
            })
        },
        active: function (tasks) {
            return tasks.filter(function (task) {
                return !task.completed
            })
        }
    }

    export default {
        data() {
            return {
                filter: 'all',
                newTask: '',
                tasks: [
                    {id: 1, name: 'Comprar pa', completed: false},
                    {id: 2, name: 'Comprar llet', completed: false},
                    {id: 3, name: 'Comprar patates', completed: true}
                ]
            }
        },
        computed: {
            total(){
                return this.tasks.length
            },
            filteredTasks() {
                return filters[this.filter](this.tasks)
            }
        },
        methods: {
            setFilter(newFilter) {
                this.filter = newFilter
            },
            add() {
                if (this.newTask === "") return
                this.tasks.splice(0, 0, {name: this.newTask, completed: false})
                this.newTask = ""
            },
            remove(task) {
                window.console.log(task)
                this.tasks.splice(this.tasks.indexOf(task), 1)
            }
        }
    }

</script>

<style>

    .strike {
        text-decoration: line-through;
    }

</style>