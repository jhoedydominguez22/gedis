<template>
  <div class="p-4">
    <!-- Fondo -->
    <div class="mb-4">
      <label class="form-label">Fondo</label>
      <select v-model="selectedFondo" @change="onFondoChange" class="form-select">
        <option disabled value="">Selecciona un fondo</option>
        <option v-for="fondo in fondos" :key="fondo.id" :value="fondo.id">{{ fondo.nombre }}</option>
      </select>
      <button @click="abrirModal('fondo')" class="btn btn-primary mt-2">Crear Fondo</button>
    </div>

    <!-- Subfondo (opcional) -->
    <div class="mb-4" v-if="selectedFondo">
      <div class="d-flex justify-content-between align-items-center mb-1">
        <label class="form-label">Subfondo <span class="text-muted">(opcional)</span></label>
        <button @click="abrirModal('subfondo')" class="btn btn-primary btn-sm">Crear Subfondo</button>
      </div>
      <select v-if="subfondos.length" v-model="selectedSubfondo" @change="fetchSecciones" class="form-select">
        <option value="">Sin subfondo</option>
        <option v-for="subfondo in subfondos" :key="subfondo.id" :value="subfondo.id">
          {{ subfondo.nombre }}
        </option>
      </select>
      <p v-else class="text-muted small">Este fondo no tiene subfondos.</p>
    </div>


    <!-- Sección -->
    <div class="mb-4" v-if="selectedFondo">
      <div class="d-flex justify-content-between align-items-center mb-1">
        <label class="form-label">Sección</label>
        <button @click="abrirModal('seccion')" class="btn btn-primary btn-sm">Crear Sección</button>
      </div>
      <select v-if="secciones.length" v-model="selectedSeccion" @change="fetchSeries" class="form-select">
        <option disabled value="">Selecciona una sección</option>
        <option v-for="seccion in secciones" :key="seccion.id" :value="seccion.id">{{ seccion.nombre }}</option>
      </select>
      <p v-else class="text-muted small">Este fondo no tiene secciones.</p>
    </div>

    <!-- Serie -->
    <div class="mb-4" v-if="selectedSeccion">
      <div class="d-flex justify-content-between align-items-center mb-1">
        <label class="form-label">Serie</label>
        <button @click="abrirModal('serie')" class="btn btn-primary btn-sm">Crear Serie</button>
      </div>
      <select v-if="series.length" v-model="selectedSerie" @change="handleSerieChange" class="form-select">
        <option disabled value="">Selecciona una serie</option>
        <option v-for="serie in series" :key="serie.id" :value="serie.id">{{ serie.nombre }}</option>
      </select>
      <p v-else class="text-muted small">Esta sección no tiene series.</p>
    </div>

    <!-- SubSerie (opcional) -->
    <div class="mb-4" v-if="selectedSeccion">
      <div class="d-flex justify-content-between align-items-center mb-1">
        <label class="form-label">Subserie <span class="text-muted">(opcional)</span></label>
        <button @click="abrirModal('subserie')" class="btn btn-primary btn-sm">Crear Subserie</button>
      </div>
      <select v-if="subseries.length" v-model="selectedSubserie" @change="fetchExpedientes" class="form-select">
        <option value="">Sin subfondo</option>
        <option v-for="subserie in subseries" :key="subserie.id" :value="subserie.id">
          {{ subserie.nombre }}
        </option>
      </select>
      <p v-else class="text-muted small">Este fondo no tiene subseries.</p>
    </div>

    <!-- Expediente -->
    <div class="mb-4" v-if="selectedSerie">
      <div class="d-flex justify-content-between align-items-center mb-1">
        <label class="form-label">Expediente</label>
        <button @click="abrirModal('expediente')" class="btn btn-primary btn-sm">Crear Expediente</button>
      </div>
      <select v-if="expedientes.length" v-model="selectedExpediente" class="form-select">
        <option disabled value="">Selecciona un expediente</option>
        <option v-for="expediente in expedientes" :key="expediente.id" :value="expediente.id">{{ expediente.nombre }}
        </option>
      </select>
      <p v-else class="text-muted small">Esta serie no tiene expedientes.</p>
    </div>

    <!-- Modales Bootstrap -->

    <!-- Modal Fondo -->
    <div ref="modalFondo" class="modal fade" tabindex="-1" aria-labelledby="modalFondoLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="modalFondoLabel" class="modal-title">Crear Fondo</h5>
            <button type="button" class="btn-close" @click="cerrarModal('fondo')" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <input v-model="nuevoFondo.nombre" placeholder="Nombre del fondo" class="form-control mb-2" />
            <input v-model="nuevoFondo.codigo" placeholder="Código del fondo" class="form-control mb-2" />
            <textarea v-model="nuevoFondo.descripcion" placeholder="Descripción" class="form-control mb-2"></textarea>
          </div>
          <div class="modal-footer">
            <button @click="crearFondo" type="button" class="btn btn-success">
              Guardar
            </button>
            <button @click="cerrarModal('fondo')" type="button" class="btn btn-secondary">
              Cancelar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Subfondo -->
    <div ref="modalSubfondo" class="modal fade" tabindex="-1" aria-labelledby="modalSubfondoLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="modalSubfondoLabel" class="modal-title">Crear Subfondo</h5>
            <button type="button" class="btn-close" @click="cerrarModal('subfondo')" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <input v-model="nuevoSubfondo.nombre" placeholder="Nombre del subfondo" class="form-control mb-2" />
            <input v-model="nuevoSubfondo.codigo" placeholder="Código del subfondo" class="form-control mb-2" />
            <textarea v-model="nuevoSubfondo.descripcion" placeholder="Descripción"
              class="form-control mb-2"></textarea>
          </div>
          <div class="modal-footer">
            <button @click="crearSubfondo" type="button" class="btn btn-success">
              Guardar
            </button>
            <button @click="cerrarModal('subfondo')" type="button" class="btn btn-secondary">
              Cancelar
            </button>
          </div>
        </div>
      </div>
    </div>



    <!-- Modal Sección -->
    <div ref="modalSeccion" class="modal fade" tabindex="-1" aria-labelledby="modalSeccionLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="modalSeccionLabel" class="modal-title">Crear Sección</h5>
            <button type="button" class="btn-close" @click="cerrarModal('seccion')" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <input v-model="nuevaSeccion.nombre" placeholder="Nombre de la sección" class="form-control mb-2" />
            <input v-model="nuevaSeccion.codigo" placeholder="Código de la sección" class="form-control mb-2" />
            <textarea v-model="nuevaSeccion.descripcion" placeholder="Descripción" class="form-control mb-2"></textarea>
          </div>
          <div class="modal-footer">
            <button @click="crearSeccion" type="button" class="btn btn-success">
              Guardar
            </button>
            <button @click="cerrarModal('seccion')" type="button" class="btn btn-secondary">
              Cancelar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Serie -->
    <div ref="modalSerie" class="modal fade" tabindex="-1" aria-labelledby="modalSerieLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="modalSerieLabel" class="modal-title">Crear Serie</h5>
            <button type="button" class="btn-close" @click="cerrarModal('serie')" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <input v-model="nuevaSerie.nombre" placeholder="Nombre de la serie" class="form-control mb-2" />
            <input v-model="nuevaSerie.codigo" placeholder="Código de la serie" class="form-control mb-2" />
            <textarea v-model="nuevaSerie.descripcion" placeholder="Descripción" class="form-control mb-2"></textarea>
          </div>
          <div class="modal-footer">
            <button @click="crearSerie" type="button" class="btn btn-success">
              Guardar
            </button>
            <button @click="cerrarModal('serie')" type="button" class="btn btn-secondary">
              Cancelar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Sub Serie -->
    <div ref="modalSubserie" class="modal fade" tabindex="-1" aria-labelledby="modalSubserieLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="modalSubserieLabel" class="modal-title">Crear SubSerie</h5>
            <button type="button" class="btn-close" @click="cerrarModal('subserie')" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <input v-model="nuevaSubserie.nombre" placeholder="Nombre de la Subserie" class="form-control mb-2" />
            <input v-model="nuevaSubserie.codigo" placeholder="Código de la Subserie" class="form-control mb-2" />
            <textarea v-model="nuevaSubserie.descripcion" placeholder="Descripción"
              class="form-control mb-2"></textarea>
          </div>
          <div class="modal-footer">
            <button @click="crearSubserie" type="button" class="btn btn-success">
              Guardar
            </button>
            <button @click="cerrarModal('subserie')" type="button" class="btn btn-secondary">
              Cancelar
            </button>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal Expediente -->
    <div ref="modalExpediente" class="modal fade" tabindex="-1" aria-labelledby="modalExpedienteLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="modalExpedienteLabel" class="modal-title">Crear Expediente</h5> <button type="button"
              class="btn-close" @click="cerrarModal('expediente')" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6"> <label>Nombre del expediente</label> <input v-model="nuevoExpediente.nombre"
                  class="form-control" /> </div>
              <div class="col-md-6"> <label>Código del expediente</label> <input v-model="nuevoExpediente.codigo"
                  class="form-control" /> </div>
              <div class="col-md-6"> <label>Etapa de ciclo vital</label> <select v-model="nuevoExpediente.estado"
                  class="form-select">
                  <option value="en_tramite">En trámite</option>
                  <option value="en_concentracion">En concentración</option>
                  <option value="en_historico">En histórico</option>
                </select> </div>
              <div class="col-md-6"> <label>Fecha de apertura</label> <input type="date"
                  v-model="nuevoExpediente.fecha_apertura" class="form-control" disabled /> </div>

              <div class="col-md-6"> <label>Fecha de creación</label> <input type="date"
                  v-model="nuevoExpediente.fecha_creacion" class="form-control" /> </div>

              <div class="col-md-6"> <label>Fecha de cierre</label> <input type="date"
                  v-model="nuevoExpediente.fecha_cierre" class="form-control" /> </div>

              <div class="col-md-6"> <label>Tiempo de conservación (en años)</label> <input type="number"
                  v-model="nuevoExpediente.tiempo_conservacion" class="form-control" /> </div>

              <div class="col-md-6"> <label>Vigencia</label> <input type="number" v-model="nuevoExpediente.vigencia"
                  class="form-control" /> </div>

              <div class="col-md-4"> <label>Número de legajos</label> <input type="number"
                  v-model="nuevoExpediente.no_legajos" class="form-control" /> </div>

              <div class="col-md-4"> <label>Número de hojas</label> <input type="number"
                  v-model="nuevoExpediente.no_hojas" class="form-control" /> </div>

              <div class="col-md-4"> <label>Número de caja</label> <input type="number"
                  v-model="nuevoExpediente.no_caja" class="form-control" /> </div>

              <div class="col-md-6"> <label for="ubicacion_topografica">Ubicación Topográfica</label> <input
                  v-model="nuevoExpediente.ubicacion_topografica" type="text" id="ubicacion_topografica"
                  class="form-control" placeholder="Escribe la ubicación topográfica"> </div>

              <div class="col-md-6"> <label>Clasificacion</label> <select v-model="nuevoExpediente.clasificacion"
                  class="form-select">
                  <option value="Pública">Pública</option>
                  <option value="Confidencial">Confidencial</option>
                  <option value="Reservada">Reservada</option>
                </select> </div>
              <div class="col-md-6"> <label>Valor documental</label> <select v-model="nuevoExpediente.caracter"
                  class="form-select">
                  <option value="Administrativo">Administrativo</option>
                  <option value="Legal">Legal</option>
                  <option value="Contable">Contable</option>
                </select> </div>
              <div class="col-md-6"> <label>Preservación</label> <select v-model="nuevoExpediente.preservacion"
                  class="form-select">
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select> </div>
              <div class="col-12"> <label>Observaciones</label> <input v-model="nuevoExpediente.observacion"
                  class="form-control" /> </div>
            </div>
          </div>
          <div class="modal-footer"> <button @click="crearExpediente" type="button"
              class="btn btn-success">Guardar</button> <button @click="cerrarModal('expediente')" type="button"
              class="btn btn-secondary">Cancelar</button> </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, onMounted, computed, watch } from 'vue'
import axios from 'axios'
import { Modal } from 'bootstrap'  // Importa la clase Modal de Bootstrap

const fondos = ref([])
const subfondos = ref([])
const secciones = ref([])
const series = ref([])
const subseries = ref([])
const expedientes = ref([])

const selectedFondo = ref('')
const selectedSubfondo = ref('')
const selectedSeccion = ref('')
const selectedSerie = ref('')
const selectedSubserie = ref('')
const selectedExpediente = ref('')

const nuevoFondo = ref({ nombre: '', codigo: '', descripcion: '' })
const nuevoSubfondo = ref({ nombre: '', codigo: '', descripcion: '' })
const nuevaSeccion = ref({ nombre: '', codigo: '', descripcion: '' })
const nuevaSerie = ref({ nombre: '', codigo: '', descripcion: '' })
const nuevaSubserie = ref({ nombre: '', codigo: '', descripcion: '' })
const nuevoExpediente = ref({
  nombre: '',
  codigo: '',
  estado: 'en_tramite',           // valor por defecto según la tabla
  fecha_apertura: '',             // formato esperado: 'YYYY-MM-DD'
  fecha_cierre: '',               // formato esperado: 'YYYY-MM-DD'
  fecha_creacion: '',             // Fecha de creación
  tiempo_conservacion: '',        // Tiempo de conservación (años)
  vigencia: '',                   // vigencia
  anios_archivo_tramite: 0,      // años en trámite
  anios_archivo_concentracion: 0,// años en concentración
  archivo_historico: 'No',       // Si es histórico permanente
  no_legajos: '',                 // Número de legajos
  no_hojas: '',                   // Número de hojas
  no_caja: '',                    // Número de caja
  ubicacion_topografica: 'Dirección General',
  clasificacion: 'Pública',       // Clasificación (Pública, Confidencial, Reservada)
  caracter: 'Administrativo',     // Carácter (Administrativo, Legal, Contable)
  preservacion: 'Si',             // Método u observación sobre preservación
  observacion: ''                 // Observaciones generales
})

const modalFondo = ref(null)
const modalSeccion = ref(null)
const modalSerie = ref(null)
const modalSubserie = ref(null)
const modalExpediente = ref(null)
const modalSubfondo = ref(null)

// Instancias de Bootstrap Modal
let bsModalFondo = null
let bsModalSeccion = null
let bsModalSerie = null
let bsModalSubserie = null
let bsModalExpediente = null
let bsModalSubfondo = null



const serieSeleccionada = computed(() => {
  return series.value.find(serie => serie.id === selectedSerie.value)
})

const onFondoChange = async () => {
  selectedSubfondo.value = '' // Limpia subfondo
  await fetchSubfondos()      // Carga subfondos del fondo seleccionado
  await fetchSecciones()      // Carga secciones del fondo si no hay subfondo
}

const handleSerieChange = () => {
  fetchSubseries()
  fetchExpedientes()
}



const fetchFondos = async () => {
  const res = await axios.get('/mostrarfondos')
  fondos.value = res.data
}

const fetchSubfondos = async () => {
  selectedSubfondo.value = ''
  selectedSeccion.value = ''
  selectedSerie.value = ''
  selectedSubserie.value = ''
  subfondos.value = []
  secciones.value = []
  series.value = []
  subseries.value = []
  expedientes.value = []

  if (!selectedFondo.value) return
  const res = await axios.get(`/fondos/${selectedFondo.value}/subfondos`)
  subfondos.value = res.data
  /* Si no hay subfondos, cargamos secciones directas al fondo           */
  if (!subfondos.value.length) await fetchSecciones()
}


const fetchSecciones = async () => {
  selectedSeccion.value = ''
  selectedSerie.value = ''
  selectedSubserie.value = ''
  selectedExpediente.value = ''
  secciones.value = []
  series.value = []
  subseries.value = []
  expedientes.value = []

  const url = selectedSubfondo.value
    ? `/subfondos/${selectedSubfondo.value}/secciones`
    : `/fondos/${selectedFondo.value}/secciones`
  const res = await axios.get(url)
  secciones.value = res.data
}


const fetchSeries = async () => {
  selectedSerie.value = ''
  selectedExpediente.value = ''
  series.value = []
  expedientes.value = []
  if (!selectedSeccion.value) return
  const res = await axios.get(`/secciones/${selectedSeccion.value}/series`)
  series.value = res.data
}

// 3. Subseries de la serie elegida
const fetchSubseries = async () => {
  selectedSubserie.value = ''
  subseries.value = []
  if (!selectedSerie.value) return
  const res = await axios.get(`/series/${selectedSerie.value}/subseries`)
  console.log('Subseries cargadas:', res.data.data) // 👈 esto te dirá si llegaron
  subseries.value = res.data.data // 👈 ¡IMPORTANTE!
}

// Actualiza expedientes, ahora considerando la subserie opcional
const fetchExpedientes = async () => {
  selectedExpediente.value = ''
  expedientes.value = []
  if (!selectedSerie.value) return
  const url = selectedSubserie.value
    ? `/subseries/${selectedSubserie.value}/expedientes`
    : `/series/${selectedSerie.value}/expedientes`
  const res = await axios.get(url)
  expedientes.value = res.data
}

const crearFondo = async () => {
  try {
    await axios.post('/guardarfondos', nuevoFondo.value)
    bsModalFondo.hide()  // Cierra el modal correctamente
    nuevoFondo.value = { nombre: '', codigo: '', descripcion: '' }
    fetchFondos()
  } catch (e) {
    console.error('Error al crear el fondo', e)
  }
}

const crearSubfondo = async () => {
  try {
    await axios.post('/guardarsubfondo', {
      ...nuevoSubfondo.value,
      id_fondo: selectedFondo.value
    })
    bsModalSubfondo.hide()
    nuevoSubfondo.value = { nombre: '', codigo: '', descripcion: '' }
    fetchSubfondos()
  } catch (e) {
    console.error('Error al crear el subfondo', e)
  }
}


const crearSeccion = async () => {
  try {
    // Asignar implícitamente el id_subfondo seleccionado
    if (selectedSubfondo.value) {
      nuevaSeccion.value.id_subfondo = selectedSubfondo.value;
    } else {
      nuevaSeccion.value.id_subfondo = null;
    }

    await axios.post(`/fondos/${selectedFondo.value}/secciones`, nuevaSeccion.value);
    bsModalSeccion.hide();
    nuevaSeccion.value = { nombre: '', codigo: '', descripcion: '' };
    fetchSecciones();
  } catch (e) {
    console.error('Error al crear la sección', e);
  }
}

const crearSerie = async () => {
  try {
    await axios.post('/guardarserie', {
      ...nuevaSerie.value,
      id_seccion: selectedSeccion.value
    })
    bsModalSerie.hide()
    nuevaSerie.value = { nombre: '', codigo: '', descripcion: '' }
    fetchSeries() // recarga la lista
  } catch (e) {
    console.error('Error al crear la serie', e)
  }
}

const crearSubserie = async () => {
  try {
    await axios.post('/guardarSubserie', {
      ...nuevaSubserie.value,
      id_serie: selectedSerie.value
    })
    bsModalSubserie.hide()
    nuevaSubserie.value = { nombre: '', codigo: '', descripcion: '' }
    fetchSubseries()
  } catch (e) {
    console.error('Error al crear la subserie', e)
  }
}

const crearExpediente = async () => {
  try {
    const datosAEnviar = {
      ...nuevoExpediente.value,
      id_serie: selectedSerie.value,
      id_subserie: selectedSubserie.value || null   // <── nuevo

    }

    console.log('Datos enviados al backend:', datosAEnviar)

    await axios.post('/guardarexpediente', datosAEnviar)

    bsModalExpediente.hide()

    // Reiniciar todos los campos del formulario
    nuevoExpediente.value = {
      nombre: '',
      codigo: '',
      estado: 'en_tramite',
      fecha_apertura: null,
      fecha_cierre: null,
      fecha_creacion: null,
      tiempo_conservacion: '',
      vigencia: '',
      no_legajos: '',
      no_hojas: '',
      no_caja: '',
      ubicacion_topografica: '',
      clasificacion: 'Pública',
      caracter: 'Administrativo',
      preservacion: '',
      observacion: ''
    }

    selectedSerie.value = null

    fetchExpedientes()
  } catch (e) {
    console.error('Error al crear el expediente:', e?.response?.data || e.message)
    alert('Hubo un error al guardar el expediente. Verifica los datos e intenta nuevamente.')
  }
}




// Funciones para abrir cada modal
const abrirModal = (tipo) => {
  switch (tipo) {
    case 'fondo':
      bsModalFondo.show()
      break
    case 'subfondo':
      bsModalSubfondo.show()
      break
    case 'seccion':
      bsModalSeccion.show()
      break
    case 'serie':
      bsModalSerie.show()
      break
    case 'subserie':
      bsModalSubserie.show()
      break
    case 'expediente':
      bsModalExpediente.show()
      break
  }
}

// Funciones para cerrar cada modal
const cerrarModal = (tipo) => {
  switch (tipo) {
    case 'fondo':
      bsModalFondo.hide()
      break
    case 'subfondo':
      bsModalSubfondo.hide()
      break
    case 'seccion':
      bsModalSeccion.hide()
      break
    case 'serie':
      bsModalSerie.hide()
      break
    case 'subserie':
      bsModalSubserie.hide()
      break
    case 'expediente':
      bsModalExpediente.hide()
      break
  }
}


onMounted(() => {
  if (modalFondo.value) bsModalFondo = new Modal(modalFondo.value)
  if (modalSubfondo.value) bsModalSubfondo = new Modal(modalSubfondo.value)
  if (modalSeccion.value) bsModalSeccion = new Modal(modalSeccion.value)
  if (modalSerie.value) bsModalSerie = new Modal(modalSerie.value)
  if (modalSubserie.value) bsModalSubserie = new Modal(modalSubserie.value)
  if (modalExpediente.value) bsModalExpediente = new Modal(modalExpediente.value)


  fetchFondos()

  const hoy = new Date().toISOString().split('T')[0]
  nuevoExpediente.value.fecha_apertura = hoy
})
</script>

<style scoped>
select,
input,
textarea {
  border-radius: 0.375rem;
}
</style>
