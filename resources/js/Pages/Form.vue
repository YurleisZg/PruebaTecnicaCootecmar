<template>
  <div class="form-container">
    <h2>Registrar Pieza</h2>

    <form @submit.prevent="submitForm">
      <!-- Proyecto -->
      <div>
        <label>Proyecto</label>
        <select v-model="form.project_id" @change="fetchBlocks">
          <option value="">Seleccione un proyecto</option>
          <option v-for="p in projects" :key="p.IDPROYECTO" :value="p.IDPROYECTO">
            {{ p.nombre }}
          </option>
        </select>
      </div>

      <!-- Bloque -->
      <div>
        <label>Bloque</label>
        <select v-model="form.block_id" @change="fetchPieces">
          <option value="">Seleccione un bloque</option>
          <option v-for="b in blocks" :key="b.id" :value="b.id">
            {{ b.nombre }}
          </option>
        </select>
      </div>

      <!-- Pieza -->
      <div>
        <label>Pieza</label>
        <select v-model="form.piece_id" @change="setTheoreticalWeight">
          <option value="">Seleccione una pieza</option>
          <option v-for="pi in pieces" :key="pi.id" :value="pi.id">
            {{ pi.name }}
          </option>
        </select>
      </div>

      <!-- Peso teórico -->
      <div>
        <label>Peso teórico</label>
        <input type="number" :value="theoreticalWeight" readonly />
      </div>

      <!-- Peso real -->
      <div>
        <label>Peso real</label>
        <input type="number" v-model.number="form.real_weight" required />
      </div>

      <!-- Diferencia -->
      <div>
        <label>Diferencia</label>
        <input type="number" :value="difference" readonly />
      </div>

      <!-- Botón -->
      <button type="submit">Registrar</button>

      <!-- Mensajes -->
      <div v-if="error" class="error">{{ error }}</div>
      <div v-if="success" class="success">{{ success }}</div>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import '../../css/form.css'

// Props que envia Inertia desde el controlador
const props = defineProps({
  projects: Array,
  usuario: Object
})

const form = ref({
  project_id: '',
  block_id: '',
  piece_id: '',
  real_weight: ''
})

const blocks = ref([])
const pieces = ref([])
const theoreticalWeight = ref(0)
const difference = ref(0)
const error = ref('')
const success = ref('')

// Traer bloques según proyecto seleccionado
const fetchBlocks = async () => {
  blocks.value = []
  pieces.value = []
  theoreticalWeight.value = 0
  difference.value = 0

  if (!form.value.project_id) return

  try {
    const res = await fetch(`/records/blocks/${form.value.project_id}`)
    const data = await res.json()
    blocks.value = data
  } catch (err) {
    console.error('Error fetching blocks:', err)
  }
}

// Traer piezas según bloque seleccionado
const fetchPieces = async () => {
  pieces.value = []
  theoreticalWeight.value = 0
  difference.value = 0

  if (!form.value.block_id) return

  try {
    const res = await fetch(`/records/pieces/${form.value.block_id}`)
    const data = await res.json()
    pieces.value = data
  } catch (err) {
    console.error('Error fetching pieces:', err)
  }
}

// Asignar peso teórico y calcular diferencia
const setTheoreticalWeight = () => {
  const selectedPiece = pieces.value.find(p => p.id == form.value.piece_id)
  theoreticalWeight.value = selectedPiece ? selectedPiece.peso_teorico : 0
  difference.value = form.value.real_weight ? form.value.real_weight - theoreticalWeight.value : 0
}

// Guardar registro
const submitForm = () => {
  error.value = ''
  difference.value = form.value.real_weight - theoreticalWeight.value

  if (!form.value.project_id || !form.value.block_id || !form.value.piece_id || !form.value.real_weight) {
    error.value = 'Todos los campos son obligatorios y el peso debe ser numérico'
    return
  }

  router.post('/records/store', { ...form.value }, {
    onSuccess: () => success.value = 'Registro guardado correctamente',
    onError: () => error.value = 'Error al guardar el registro'
  })
}
</script>

<style scoped>
/* Aquí puedes usar tu form.css o adaptarlo */
</style>
