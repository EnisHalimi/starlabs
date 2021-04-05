<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Employee
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
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name" v-model="form.name" type="text" placeholder="Name">
                            <div v-if="errors.name" class="text-red-500 text-xs">{{ errors.name }}</div>
                        </div>
                        <div class="w-full  md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="occupation">
                                Occupation
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="occupation" type="text"  v-model="form.occupation" placeholder="Occupation">
                             <div v-if="errors.occupation" class="text-red-500 text-xs">{{ errors.occupation }}</div>
                        </div>
                    </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                           E-Mail
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" v-model="form.email" type="email" placeholder="E-Mail">
                         <div v-if="errors.email" class="text-red-500 text-xs">{{ errors.email }}</div>
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="social_media">
                            Social Media
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3  leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="social_media" v-model="form.social_media"  type="text" placeholder="Social Media">
                         <div v-if="errors.social_media" class="text-red-500 text-xs">{{ errors.social_media }}</div>
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="photo">
                                Photo
                            </label>
                            <input type="file" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="photo" ref="photo">
                             <div v-if="errors.photo" class="text-red-500 text-xs">{{ errors.photo }}</div>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                     <div class="w-full   px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="bio">
                                Biography
                            </label>
                           <textarea  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3  leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="bio" v-model="form.bio"  placeholder="Biography"></textarea>
                             <div v-if="errors.bio" class="text-red-500 text-xs">{{ errors.bio }}</div>
                        </div>
                </div>
                    <div class="flex w-full flex-row-reverse float-right"  >
                        <button @click="update()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                              Ndrysho
                        </button>
                        <button @click="deleteEmployee()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-500 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                              Fshij
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
            employee: Object,
            errors: Object,
        },
        components: {
            AppLayout,
        },
         data() {
        return {
             form:this.$inertia.form({
                _method: 'PUT',
                name: this.employee.name,
                occupation: this.employee.occupation,
                email: this.employee.email,
                bio: this.employee.bio,
                photo: '',
                social_media: this.employee.social_media,
                company_id: this.employee.company_id,
            }),
        };
    },
    methods: {
        submitForm() {},
        update(){
             if (this.$refs.photo) {
                this.form.photo = this.$refs.photo.files[0]
            }
            if (!confirm("A jeni i sigurtë që dëshironi të ndryshoni punetorin?")) return;
             this.form.post(this.route('employee.update', this.employee))
        },
        deleteEmployee() {
            if (!confirm("A jeni i sigurtë që dëshironi të fshini punetorin?")) return;
            this.$inertia.delete(this.route('employee.destroy', this.employee))
        },
    },
    }
</script>
