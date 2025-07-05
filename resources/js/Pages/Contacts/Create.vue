<template>
  <div class="p-6 max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Criar Contato</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block font-medium mb-1">Nome</label>
        <input
          type="text"
          v-model="form.name"
          class="w-full border px-4 py-2 rounded"
        />
        <div v-if="form.errors.name" class="text-red-600 text-sm mt-1">
          {{ form.errors.name }}
        </div>
      </div>

      <div class="mb-4">
        <label class="block font-medium mb-1">Email</label>
        <input
          type="email"
          v-model="form.email"
          class="w-full border px-4 py-2 rounded"
        />
        <div v-if="form.errors.email" class="text-red-600 text-sm mt-1">
          {{ form.errors.email }}
        </div>
      </div>

      <div class="mb-4">
        <label class="block font-medium mb-1">Telefone</label>
        <input
          type="text"
          v-model="form.phone"
          class="w-full border px-4 py-2 rounded"
        />
        <div v-if="form.errors.phone" class="text-red-600 text-sm mt-1">
          {{ form.errors.phone }}
        </div>
      </div>

      <div class="flex justify-between items-center gap-4">
        <button
          type="button"
          @click="goBack"
          class="text-gray-600 hover:underline"
          :disabled="form.processing"
        >
          Cancelar
        </button>
        <button
          type="submit"
          class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded"
          :disabled="form.processing"
        >
          Salvar
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
  import { useForm } from '@inertiajs/inertia-vue3'
  import { Inertia } from '@inertiajs/inertia'

  const form = useForm({
    name: '',
    email: '',
    phone: '',
  })

  function submit() {
    form.post('/contacts', {
      onSuccess() {
        Inertia.get('/contacts')
      }
    })
  }

  function goBack() {
    Inertia.get('/contacts')
  }
</script>