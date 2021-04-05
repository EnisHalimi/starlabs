<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Company
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <inertia-link :href="route('company.create')">
                        <button class="ml-2 mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add company</button>
                    </inertia-link>
                 <ul class="list-none p-5">
                        <li v-for="(company,index) in paginated" :key="company.id" class="m-2 shadow-md w-full h-auto md:h-auto md:items-center flex px-5 py-2 grid grid-cols-3 md:grid-cols-10 gap-4">
                            <div class="order-2 md:order-1 col-span-1 flex md:justify-start justify-end items-center">
                                <svg height="40" width="40">
                                <circle cx="20" cy="20" r="12" stroke="#bfdbfe" stroke-width="6" fill="#1e3a8a" />
                                <text x="16" y="20" font-family="Verdana" font-size="10pt" fill="#FFF" dy="0.35em">{{index+1}}</text>
                                </svg>
                            </div>
                            <div class="order-1 md:order-2 grid grid-cols-2 md:grid-cols-1 col-span-2 flex justify-start items-center">
                                <img class="bg-cover w-14 justify-self-center" :src="company.picture" alt="">
                                <span class="justify-self-center md:align-center text-lg text-black md:text-xs md:text-blue-400"> <inertia-link :href="route('company.edit',company.id)">
                                    {{company.name}}
                                </inertia-link> </span>
                            </div>
                            <div class="order-3 grid grid-cols-1  col-span-3">
                                <span class="border-2 border-dotted w-full border-blue-900 text-blue-900 font-bold px-5 py-1 md:px-10 md:py-2 m-0 text-lg text-center mb-2">{{company.banner}}</span>
                                <span class="justify-self-center text-xs"> Terms & Conditions</span>
                            </div>
                            <div class="col-span-3  md:col-span-2 md:mx-auto order-4 grid  grid-flow-row  ">
                                <span class="md:justify-self-start text-xs">
                                    <svg class="text-green-500 w-5 h-5 inline  mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{company.quality1}}
                                </span>
                                <span class="md:justify-self-start text-xs">
                                    <svg class="text-green-500 w-5 h-5 inline  mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{company.quality2}}
                                </span>
                                <span class="md:justify-self-start text-xs">
                                    <svg class="text-green-500 w-5 h-5 inline mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{company.quality3}}
                                </span>
                            </div>
                            <div class=" col-span-3 md:col-span-2 order-5 grid grid-flow-row ">
                                <span class="justify-self-center text-sm mb-2 font-bold text-blue-900">{{company.name}} Website</span>
                                <a :href="'http://'+company.website" class="bg-yellow-500 py-2 px-5 text-white text-center">ORDER NOW</a>
                            </div>
                        </li>
                    </ul>
                     <button v-show="companies.length > shownItemsNumber" @click="showMore" class="m-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded justify-self-center">Show more</button>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        props: {
            companies: Object,
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
                return this.companies.slice(0,this.shownItemsNumber)
            }
        },
        methods:{
            showMore(){
                this.shownItemsNumber += 5
            },
        }
    }
</script>
