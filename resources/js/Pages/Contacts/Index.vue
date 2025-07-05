<template>
  <div class="p-6">
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-bold">Lista de Contatos</h1>
      <button
        @click="goToCreate"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"
      >
        Criar Contato
      </button>
    </div>

    <table class="min-w-full bg-white border">
      <thead>
        <tr>
          <th class="border px-4 py-2">Nome</th>
          <th class="border px-4 py-2">Email</th>
          <th class="border px-4 py-2">Telefone</th>
          <th class="border px-4 py-2">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="contact in contacts.data" :key="contact.id">
          <td class="border px-4 py-2">{{ contact.name }}</td>
          <td class="border px-4 py-2">{{ contact.email }}</td>
          <td class="border px-4 py-2">{{ contact.phone }}</td>
          <td class="flex justify-center border px-4 py-2 space-x-2">
            <button
              @click="goToEdit(contact.id)"
              class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded"
            >
              Editar
            </button>
            <button
              @click="deleteContact(contact.id)"
              class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded"
            >
              Deletar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
    import { Inertia } from '@inertiajs/inertia'
    import { defineProps } from 'vue'

    const props = defineProps({
      contacts: Object,
    })

    function goToCreate() {
      Inertia.get('/contacts/create')
    }

    function goToEdit(id) {
      Inertia.get(`/contacts/${id}/edit`)
    }

    function deleteContact(id) {
      if (confirm('Tem certeza que deseja deletar este contato?')) {
        Inertia.delete(`/contacts/${id}`)
      }
    }
</script>
