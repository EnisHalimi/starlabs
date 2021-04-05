<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <inertia-link :href="route('user.create')">
                        <button class="ml-2 mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add user</button>
                    </inertia-link>
                 <ul class="list-none p-5">
                        <li v-for="(user,index) in paginated" :key="user.id" class="m-2 shadow-md w-full h-auto md:h-auto md:items-center flex px-5 py-2 grid grid-cols-1 md:grid-cols-9 gap-4">
                            <div class="flex items-center ">
                                <svg height="40" width="40">
                                <circle cx="20" cy="20" r="12" stroke="#bfdbfe" stroke-width="6" fill="#1e3a8a" />
                                <text x="16" y="20" font-family="Verdana" font-size="10pt" fill="#FFF" dy="0.35em">{{index+1}}</text>
                                </svg>
                            </div>
                            <div class="flex items-center ">
                                <img class="bg-cover w-14 justify-self-center rounded-full" :src="user.profile_photo_url" alt="">
                            </div>
                            <div class="flex items-center md:col-span-2">
                                <span class="justify-self-center text-lg text-gray-500">
                                        {{user.name}}
                                </span>
                            </div>
                            <div class="flex items-center md:col-span-2">
                                  <span class="justify-self-center  text-lg text-gray-500">{{user.email}}</span>
                            </div>
                            <div class="flex items-center md:col-span-2">
                                <span v-if="user.role == 1" class="text-lg text-gray-500"> Administrator</span>
                                <span v-else class="text-lg text-gray-500"> Perdorues</span>
                            </div>
                            <div class="flex md:items-center items-end">
                                <inertia-link :href="route('user.edit',user.id)">
                                     <button class="ml-2 mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                </inertia-link>
                            </div>
                        </li>
                    </ul>
                    <button v-show="users.length > shownItemsNumber" @click="showMore" class="m-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded justify-self-center">Show more</button>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        props: {
            users: Object,
        },
        components: {
            AppLayout,
        },
        data(){
            return{
                shownItemsNumber: 5,
            };
        },
        computed: {
            paginated() {
                return this.users.slice(0,this.shownItemsNumber)
            }
        },
        methods:{
            showMore(){
                this.shownItemsNumber += 5
            },
        }
    }
</script>
