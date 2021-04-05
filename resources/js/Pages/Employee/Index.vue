<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Employee
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-200 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="grid grid-rows-3 md:grid-cols-3 mx-5 md:grid-rows-1">
                        <div class="flex md:flex-row justify-center md:justify-start ">
                        <inertia-link :href="route('employee.create')">
                            <button class="ml-2 mt-2 bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Add new user</button>
                        </inertia-link>
                        <button  @click="showMore" class="ml-2 mt-2 bg-white hover:bg-gray-100 text-white font-bold py-2 px-4 rounded ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6  text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                        </div>
                        <div class="flex justify-center  flex-wrap content-center pt-2 ">
                            <span class="text-xs text-gray-600 justify-self-center">Showing 1 to {{shownItemsNumber}} of {{employee.length}} entries</span>
                        </div>
                        <div class="flex justify-center md:justify-end relative ">
                            <button @click="search" class="absolute inset-y-4 right-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                            <input class=" mt-2 appearance-none block md:w-1/2 w-full bg-white text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="search" type="text"  v-model="searchForm.search" placeholder="Search">

                        </div>
                    </div>
                 <ul class="list-none mx-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <li v-for="employee in paginated" :key="employee.id" class="bg-white rounded-md mt-2 shadow-md w-full  col-span-1">
                            <div class="grid md:grid-rows-4 md:grid-flow-col px-2">
                                 <img class="bg-cover rounded-full w-14 justify-self-center self-center order-2 md:order-1 md:row-span-4" :src="employee.picture" alt="">
                                    <span class=" md:row-start-2 md:justify-self-start justify-self-center ml-2 text-sm font-bold text-gray-500 order-3">{{employee.name}}</span>
                                    <span class="md:justify-self-start justify-self-center order-4 ml-2 text-sm text-gray-500 ">{{employee.occupation}}</span>
                                <button class="md:col-start-6 justify-self-end order-1">...</button>

                            </div>
                            <div class="p-2">
                                <span class="justify-self-start text-xs"> {{employee.bio}}</span>
                            </div>
                            <div class="p-2  ">
                                <div class="flex flex-row mb-1 justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                <span class="md:justify-self-start text-xs text-gray-400  md:flex-grow ml-1">

                                    {{employee.email}}
                                </span>
                                </div>
                                <div class="flex flex-row  justify-center">
                                <svg  class="h-4 w-4 text-gray-400 inline" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.9999 7.00005C15.9999 6.44776 16.4477 6.00005 16.9999 6.00005C17.5522 6.00005 17.9999 6.44776 17.9999 7.00005C17.9999 7.55233 17.5522 8.00005 16.9999 8.00005C16.4477 8.00005 15.9999 7.55233 15.9999 7.00005Z" fill="currentColor"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9999 7.25005C9.37659 7.25005 7.24994 9.37669 7.24994 12C7.24994 14.6234 9.37659 16.75 11.9999 16.75C14.6233 16.75 16.7499 14.6234 16.7499 12C16.7499 9.37669 14.6233 7.25005 11.9999 7.25005ZM8.74994 12C8.74994 10.2051 10.205 8.75005 11.9999 8.75005C13.7949 8.75005 15.2499 10.2051 15.2499 12C15.2499 13.795 13.7949 15.25 11.9999 15.25C10.205 15.25 8.74994 13.795 8.74994 12Z" fill="currentColor"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.2582 2.83306C13.7916 2.44562 10.2083 2.44562 6.74171 2.83306C4.72965 3.05794 3.10532 4.64295 2.86876 6.66548C2.45423 10.2098 2.45423 13.7903 2.86876 17.3346C3.10532 19.3571 4.72965 20.9422 6.74171 21.167C10.2083 21.5545 13.7916 21.5545 17.2582 21.167C19.2702 20.9422 20.8946 19.3571 21.1311 17.3346C21.5457 13.7903 21.5457 10.2098 21.1311 6.66548C20.8946 4.64295 19.2703 3.05794 17.2582 2.83306ZM6.90832 4.32378C10.2642 3.94871 13.7357 3.94871 17.0916 4.32378C18.4217 4.47244 19.4872 5.52205 19.6413 6.83973C20.0423 10.2683 20.0423 13.7318 19.6413 17.1604C19.4872 18.478 18.4217 19.5277 17.0916 19.6763C13.7357 20.0514 10.2642 20.0514 6.90832 19.6763C5.57821 19.5277 4.51272 18.478 4.35861 17.1604C3.95761 13.7318 3.95761 10.2683 4.35861 6.83973C4.51272 5.52205 5.57821 4.47244 6.90832 4.32378Z" fill="currentColor"/>
                                </svg>
                                <span class="md:justify-self-start text-xs text-gray-400 md:flex-grow ml-1">
                                    {{employee.social_media}}
                                </span>
                            </div>

                            </div>
                            <div class="border-t border-gray-200 py-5 px-2 flex justify-center md:justify-end">
                                    <button class=" bg-yellow-500 hover:bg-yellow-700 text-white text-sm  py-1 px-2 font-bold border border-gray-200 rounded-lg md:self-center justify-self-end"> Message</button>
                                    <inertia-link :href="route('employee.edit',employee.id)" >
                                    <button class=" bg-white hover:bg-gray-300 text-gray-500 text-sm py-1 font-bold px-2 rounded-lg border border-gray-200 md:self-center ml-1 justify-self-end">Profile </button></inertia-link>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import pickBy from 'lodash/pickBy';
    import throttle from 'lodash/throttle';

    export default {
        props: {
            employee: Object,
            filters: Object,
        },
        components: {
            AppLayout,
        },
        data(){
            return{
                shownItemsNumber: 5,
                searchForm:{
                    search: this.filters.search,
                },
            };
        },
        computed: {
            paginated() {
                return this.employee.slice(0,this.shownItemsNumber)
            }
        },
        watch: {
            searchForm: {
            handler: throttle(function() {
                let query = pickBy(this.searchForm)
                this.$inertia.replace(this.route('employee.index', Object.keys(query).length ? query : { remember: 'forget' }))
            }, 150),
            deep: true,
            },
        },
        methods:{
            showMore(){
                this.shownItemsNumber += 5
            },
        }
    }
</script>
