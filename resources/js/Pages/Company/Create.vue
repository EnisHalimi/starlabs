<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Company
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                  <form class="w-full p-10">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Name
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name" v-model="form.name" type="text" placeholder="Company Name">
                            <div v-if="errors.name" class="text-red-500 text-xs">{{ errors.name }}</div>
                        </div>
                        <div class="w-full  md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="website">
                                Website
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="website" type="text"  v-model="form.website" placeholder="Website">
                             <div v-if="errors.website" class="text-red-500 text-xs">{{ errors.website }}</div>
                        </div>
                    </div>
                     <div class="flex flex-wrap -mx-3 mb-6">
                         <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="banner">
                            Banner
                        </label>
                         <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="banner" v-model="form.banner" type="text" placeholder="Company Banner">
                          <div v-if="errors.banner" class="text-red-500 text-xs">{{ errors.banner }}</div>
                        </div>
                         <div class="w-full  md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="logo">
                                Logo
                            </label>
                           <input type="file" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="photo" ref="photo">
                        </div>

                    </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="quality1">
                            First Quality
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="quality1" v-model="form.quality1" type="text" placeholder="First Quality">
                         <div v-if="errors.quality1" class="text-red-500 text-xs">{{ errors.quality1 }}</div>
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="quality2">
                            Second Quality
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3  leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="quality2" v-model="form.quality2"  type="text" placeholder="Second Quality">
                         <div v-if="errors.quality2" class="text-red-500 text-xs">{{ errors.quality2 }}</div>
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="quality3">
                            Third Quality
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3  leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="quality3" v-model="form.quality3"  type="text" placeholder="Third Quality">
                         <div v-if="errors.quality3" class="text-red-500 text-xs">{{ errors.quality3 }}</div>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                     <div class="w-full   px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="user">
                                Company Manager
                            </label>
                            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 mb-3 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="user" v-model="form.user_id">
                                <option v-for="user in users" :key="user.id" :value="user.id">
                                    {{ user.name }}
                                </option>
                            </select>
                             <div v-if="errors.user_id" class="text-red-500 text-xs">{{ errors.user_id }}</div>
                        </div>
                </div>
                    <div class="flex w-full flex-row-reverse float-right"  >
                        <button @click="save(form)" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                              Ruaj
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        props: {
            users: Array,
            errors: Object,
        },
        components: {
            AppLayout,
        },
         data() {
        return {
            form:{
                name: this.name,
                logo: this.logo,
                banner: this.banner,
                website: this.website,
                quality1: this.quality1,
                quality2: this.quality2,
                quality3: this.quality3,
                user_id: this.user_id,
            },
        };
    },
    methods: {
        submitForm() {},
        save: function (data) {
             if (this.$refs.photo) {
                this.form.logo = this.$refs.photo.files[0]
            }
            this.$inertia.post(this.route('company.store'), data)
        },
    },
    }
</script>
