<template>
    <div class="login-page">
    <div class="login-container">
      <h2>Iniciar sesión</h2>

      <form @submit.prevent="form.post('/login')">
        <div class="input-group">
          <label for="usuario">Usuario</label>
          <input id="usuario" v-model="form.nombre_usuario" type="text" placeholder="Ingresa tu usuario" />
          <div v-if="form.errors.nombre_usuario" class="error">{{ form.errors.nombre_usuario }}</div>
        </div>

        <div class="input-group">
          <label for="password">Contraseña</label>
          <input id="password" v-model="form.password" type="password" placeholder="••••••••" />
          <div v-if="form.errors.password" class="error">{{ form.errors.password }}</div>
        </div>

        <button type="submit">Entrar</button>
      </form>

        <div v-if="$page?.props?.flash?.error" class="error">
        {{ $page.props.flash.error }}
        </div>

    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import '../../css/login.css'

const form = useForm({
  nombre_usuario: '',
  password: ''
})
</script>