const { createApp, ref, computed } = Vue;

const app = createApp({
    setup() {
        const email = ref('');
        const name = ref('');
        const password = ref('');
        const errors = ref([]);

        const register = async () => {
            errors.value = [];

            try {
                const formData = new FormData();
                formData.append('name', name.value);
                formData.append('email', email.value);
                formData.append('password', password.value);
                await axios.post('/users', formData);
                window.location.replace("/auth/login");
            } catch (error) {
                errors.value = error.response.data;
                console.error(errors.value.email);
            }
        }


        return {
            email,
            name,
            password,
            errors,

            register,
        }
    }
});

app.mount('#app');