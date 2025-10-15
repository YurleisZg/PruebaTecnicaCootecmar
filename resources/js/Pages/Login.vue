<template>
    <div class="login-page">
    <div class="login-container">
      <h2>Iniciar sesión</h2>

      <form @submit.prevent="submit">
        <div class="input-group">
          <label for="usuario">Usuario</label>
          <input id="usuario" v-model="form.name" type="text" placeholder="Ingresa tu usuario" required />
          <div v-if="form.errors.name" class="error">{{ form.errors.name }}</div>
        </div>

        <div class="input-group">
          <label for="password">Contraseña</label>
          <input id="password" v-model="form.password" type="password" required placeholder="Ingresa tu contraseña" />
          <div v-if="form.errors.password" class="error">{{ form.errors.password }}</div>
        </div>

        <button type="submit">Entrar</button>
      </form>

     <div v-if="form.errors" class="text-red-500 text-sm mt-3">
        {{ form.errors }}
      </div>
        
    </div>
  </div>
</template>

<script setup>
import { ref, defineProps } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'
import '../../css/login.css'
import { use } from 'react'

const form = useForm({
  name: '',
  password: ''
})

const props = defineProps({ errors: Object })
console.log('Errores de la página:', props.errors)

const submit = () => {
  form.post('/login', {
    onSuccess: () => {
      console.log('Inicio de sesión exitoso')
    },
    onError: (errors) => {
      console.log('Errores de validación:', errors)
    }
  })
}

console.log('Formulario inicializado:', form.errors)
</script>