<template>
  <div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Configuración de Expediente</h1>

    <div class="mb-4">
      <label class="block font-semibold mb-2">Expediente activo:</label>

      <!-- Dropdown para seleccionar expediente -->
      <select
        v-model="selectedExpediente"
        class="border border-gray-300 rounded p-2 w-full"
      >
        <option disabled value="">Seleccione un expediente</option>
        <option
          v-for="exp in expedientes"
          :key="exp.id"
          :value="exp.id"
        >
          {{ exp.nombre }} ({{ exp.codigo }})
        </option>
      </select>
    </div>

    <!-- Botón de guardar -->
    <button
      @click="guardarExpediente"
      class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"
    >
      Guardar configuración
    </button>

    <p v-if="mensaje" class="mt-3 text-green-600">{{ mensaje }}</p>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Configuration",
  data() {
    return {
      expedientes: [],
      selectedExpediente: "",
      mensaje: "",
    };
  },
  mounted() {
    this.obtenerExpedientes();
    this.obtenerConfiguracion();
  },
  methods: {
    async obtenerExpedientes() {
      try {
        const response = await axios.get("/obtenerexpedientes"); // ← Ruta backend
        this.expedientes = response.data;
      } catch (error) {
        console.error("Error al obtener expedientes:", error);
      }
    },
    async obtenerConfiguracion() {
      try {
        const response = await axios.get("/expedienteconsultas");
        this.selectedExpediente = response.data.valor || "";
      } catch (error) {
        console.error("Error al obtener configuración:", error);
      }
    },
    async guardarExpediente() {
      if (!this.selectedExpediente) return alert("Seleccione un expediente");

      try {
        await axios.post("/asignarexpediente", {
          expediente_id: this.selectedExpediente,
        });
        this.mensaje = "Configuración guardada correctamente ✅";
      } catch (error) {
        console.error("Error al guardar configuración:", error);
        this.mensaje = "Ocurrió un error al guardar ❌";
      }
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 600px;
}
</style>
