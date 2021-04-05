<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit User
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
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name" v-model="form.name" type="text" placeholder="User Name">
                            <div v-if="errors.name" class="text-red-500 text-xs">{{ errors.name }}</div>
                        </div>
                        <div class="w-full  md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                                E-Mail
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email"  v-model="form.email" placeholder="E-mail">
                             <div v-if="errors.email" class="text-red-500 text-xs">{{ errors.email }}</div>
                        </div>
                    </div>
                     <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                                Password
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="password" v-model="form.password" type="password" placeholder="*********">
                            <div v-if="errors.password" class="text-red-500 text-xs">{{ errors.password }}</div>
                        </div>
                        <div class="w-full  md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password_confirmation">
                                Password Confirmation
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="password_confirmation" v-model="form.password_confirmation" type="password" placeholder="*********">
                             <div v-if="errors.password" class="text-red-500 text-xs">{{ errors.password }}</div>
                        </div>

                    </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                     <div class="w-full   px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="role">
                                Role
                            </label>
                            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 mb-3 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="role" v-model="form.role">
                                <option value="1" >Administrator</option>
                                <option value="0" >Perdorues</option>
                            </select>
                             <div v-if="errors.role" class="text-red-500 text-xs">{{ errors.role }}</div>
                        </div>
                </div>
                    <div class="flex w-full flex-row-reverse float-right"  >
                        <button @click="update(form)" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                              Ndrysho
                        </button>
                        <button @click="deleteUser()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-500 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
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
            user: Object,
            errors: Object,
        },
        components: {
            AppLayout,
        },
        data() {
        return {
            form:{
                name: this.user.name,
                email: this.user.email,
                password:null,
                password_confirmation: null,
                role: this.user.role,
            },
        };
        },
        methods: {
            submitForm() {},
            update(data) {
                if (!confirm("A jeni i sigurtë që dëshironi të ndryshoni perdoruesin?")) return;
                this.$inertia.put(this.route('user.update', this.user),data)
            },
            deleteUser() {
                if (!confirm("A jeni i sigurtë që dëshironi të fshini perdoruesin?")) return;
                this.$inertia.delete(this.route('user.destroy', this.user))
            },
        },
}
</script>
