<div id="app" class="flex items-center mt-12">
    <div class="w-full">
        <div class="card bg-white p-8 rounded-lg shadow-xl md:w-3/4 mx-auto lg:w-1/3">
            <h3 class="text-center text-2xl font-semibold">User Login</h3>

            <form @submit.prevent="register" method="post" class="max-w-sm mx-auto">
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="email">
                        Email
                    </label>
                    <input
                        type="text"
                        id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Email"
                        required
                        v-model="email"
                    />
                    <template v-for="error in errors['email']">
                        <span class="text-red-500" v-text="error"></span>
                    </template>
                </div>
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="email">
                        Nombre
                    </label>
                    <input
                        type="text"
                        id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Nombre"
                        required
                        v-model="name"
                    />
                    <template v-for="error in errors['name']">
                        <span class="text-red-500" v-text="error"></span>
                    </template>
                </div>
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="email">
                        Password
                    </label>
                    <input
                        type="password"
                        id="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Contraseña"
                        required
                        v-model="password"
                    />
                    <template v-for="error in errors['password']">
                        <span class="text-red-500" v-text="error"></span>
                    </template>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Registrar
                </button>
            </form>
        </div>
    </div>
</div>

<script src="../../public/js/register.js"></script>
