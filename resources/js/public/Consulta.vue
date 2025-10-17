<template>
    <div class="container mt-4 mb-5">
        <div class="card shadow">
            <div class="card-body p-5">
                <!-- Encabezado con logos -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <img src="assets/escudo.png" alt="Logo Izquierda" style="height: 120px;" />
                    <div class="text-center">
                        <h2 class="fw-bold text-uppercase mb-1">
                            Archivo General del Estado de Quintana Roo
                        </h2>
                        <h4 class="fw-semibold mb-1">
                            Formato de consulta y solicitud de reproducción
                        </h4>
                        <p class="small">Departamento de Biblioteca y Hemeroteca</p>
                    </div>
                    <img src="assets/agqroo1.png" alt="Logo Derecha" style="height: 120px;" />
                </div>

                <!-- Fecha y Folio -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Fecha de consulta:</label>
                        <input type="date" class="form-control" v-model="formData.fecha" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Folio:</label>
                        <input type="text" class="form-control" v-model="formData.folio" />
                    </div>
                </div>

                <!-- Datos de identificación -->
                <h5 class="fw-bold border-bottom pb-2 mb-3">Datos de Identificación</h5>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nombre:</label>
                        <input type="text" class="form-control" v-model="formData.nombre" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Edad:</label>
                        <input type="number" class="form-control" v-model="formData.edad" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Teléfono:</label>
                        <input type="text" class="form-control" v-model="formData.telefono" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Procedencia (Gubernamental / Educativa):</label>
                        <input type="text" class="form-control" v-model="formData.procedencia" />
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Correo electrónico:</label>
                        <input type="email" class="form-control" v-model="formData.correo" />
                    </div>
                </div>

                <!-- Nivel de estudios -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nivel de estudios:</label>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" v-model="formData.estudio_basica" />
                                    <label class="form-check-label">Educación Básica</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        v-model="formData.estudio_secundaria" />
                                    <label class="form-check-label">Secundaria</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        v-model="formData.estudio_bachillerato" />
                                    <label class="form-check-label">Media superior / Bachillerato</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        v-model="formData.estudio_licenciatura" />
                                    <label class="form-check-label">Licenciatura</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        v-model="formData.estudio_maestria" />
                                    <label class="form-check-label">Maestría</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        v-model="formData.estudio_doctorado" />
                                    <label class="form-check-label">Doctorado</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        v-model="formData.estudio_posgrado" />
                                    <label class="form-check-label">Posgrado</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tema de consulta:</label>
                        <input type="text" class="form-control" v-model="formData.tema" />
                    </div>
                </div>

                <!-- Material consultado -->
                <h5 class="fw-bold border-bottom pb-2 mb-3">Material consultado</h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                v-model="formData.mat_documentos" /> <label class="form-check-label">Documentos
                                técnicos</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                v-model="formData.mat_libros" /> <label class="form-check-label">Libros</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                v-model="formData.mat_planos" /> <label class="form-check-label">Planos</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                v-model="formData.mat_publicaciones" /> <label class="form-check-label">Publicaciones
                                periódicas</label></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                v-model="formData.mat_poe" /> <label class="form-check-label">Periódico Oficial del
                                Estado</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                v-model="formData.mat_dof" /> <label class="form-check-label">Diario Oficial de la
                                Federación</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                v-model="formData.mat_informes" /> <label class="form-check-label">Informes de
                                Gobierno</label></div>
                    </div>
                </div>

                <!-- Objetivos -->
                <h5 class="fw-bold border-bottom pb-2 mb-3">Objetivos de la información</h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                v-model="formData.obj_tesis" /> <label class="form-check-label">Tesis</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                v-model="formData.obj_investigacion" /> <label
                                class="form-check-label">Investigación</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                v-model="formData.obj_publicacion" /> <label
                                class="form-check-label">Publicación</label></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                v-model="formData.obj_exposicion" /> <label class="form-check-label">Exposición</label>
                        </div>
                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                v-model="formData.obj_tarea" /> <label class="form-check-label">Tarea</label></div>
                    </div>
                </div>

                <!-- Tipo de documento -->
                <h5 class="fw-bold border-bottom pb-2 mb-3">Tipo de documento consultado</h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                v-model="formData.tipo_bibliografico" /> <label
                                class="form-check-label">Bibliográfico</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                v-model="formData.tipo_cartografico" /> <label
                                class="form-check-label">Cartográfico</label></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                v-model="formData.tipo_hemerografico" /> <label
                                class="form-check-label">Hemerográfico</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                v-model="formData.tipo_documento_tecnico" /> <label class="form-check-label">Documento
                                técnico</label></div>
                    </div>
                </div>

                <!-- Finalidad -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Finalidad de la consulta:</label>
                    <textarea class="form-control mb-3" v-model="formData.finalidad"></textarea>
                    <label class="form-label fw-semibold">Fecha y número de oficio:</label>
                    <textarea class="form-control" v-model="formData.oficio"></textarea>
                </div>

                <!-- Solicito información en -->
                <h5 class="fw-bold border-bottom pb-2 mb-3">Solicito información en</h5>
                <div class="mb-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.solicito_digital" />
                        <label class="form-check-label">Respaldo digital</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.solicito_fotocopias" />
                        <label class="form-check-label">Fotocopias</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="formData.solicito_copias" />
                        <label class="form-check-label">Número de copias</label>
                    </div>
                </div>

                <!-- Tabla de materiales -->
                <h5 class="fw-bold border-bottom pb-2 mb-3">Material solicitado</h5>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Título</th>
                                <th scope="col">Número de inventario / nomenclatura</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in formData.materiales" :key="index">
                                <td><input type="text" class="form-control" v-model="row.titulo" /></td>
                                <td><input type="text" class="form-control" v-model="row.inventario" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Firmas -->
                <div class="row mb-4">
                    <div class="col-md-6 text-center">
                        <label class="fw-bold">Firma del consultante:</label>
                        <div class="border p-2 mx-auto" style="width: 400px; height: 200px;">
                            <canvas ref="canvas" width="380" height="180" style="border:1px solid #ccc;"></canvas>
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn-sm btn-secondary me-2" @click="clearSignature">
                                Limpiar
                            </button>
                            <button type="button" class="btn btn-sm btn-success" @click="saveSignature">
                                Guardar Firma
                            </button>
                        </div>
                    </div>

                    <div class="col-md-6 text-center">
                        <label class="fw-semibold">Atendió y entregó (nombre y firma)</label>
                        <select class="form-select mt-2" v-model="selectedPerson" @change="loadSignature">
                            <option value="">Seleccione</option>
                            <option value="vidal">DIAZ ARGAEZ VIDAL ALFREDO</option>
                            <option value="sanjuana">FABELA SOTO SAN JUANA</option>
                            <option value="mirza">CITUK RUIZ MIRZA MAGALY</option>
                            <option value="beto">CABRERA CANCHE ROBERT</option>
                        </select>
                        <div class="border p-4 mt-3" style="height: 250px;">
                            <canvas ref="attendedCanvas" width="380" height="180"
                                style="border:1px solid #ccc;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="alert alert-secondary small text-center" role="alert">
                    El Archivo General del Estado de Quintana Roo (AGQROO), es responsable del tratamiento de los datos
                    personales que nos proporcione. Sus datos personales serán utilizados con la finalidad de control
                    del servicio de consulta y los acervos...
                </div>

                <div class="text-center">
                    <button class="btn btn-primary px-5" @click="generarPDF">
                        Generar PDF y Enviar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import SignaturePad from "signature_pad";
import jsPDF from "jspdf";

const canvas = ref(null);
let signaturePad;
const attendedCanvas = ref(null);
let ctx;

const selectedPerson = ref("");

// Datos de formulario
const formData = ref({
    fecha: "",
    folio: "",
    nombre: "",
    edad: "",
    telefono: "",
    procedencia: "",
    correo: "",
    tema: "",
    // Estudios
    estudio_basica: false,
    estudio_secundaria: false,
    estudio_bachillerato: false,
    estudio_licenciatura: false,
    estudio_maestria: false,
    estudio_doctorado: false,
    estudio_posgrado: false,
    // Material
    mat_documentos: false,
    mat_libros: false,
    mat_planos: false,
    mat_publicaciones: false,
    mat_poe: false,
    mat_dof: false,
    mat_informes: false,
    // Objetivo
    obj_tesis: false,
    obj_investigacion: false,
    obj_publicacion: false,
    obj_exposicion: false,
    obj_tarea: false,
    // Tipo
    tipo_bibliografico: false,
    tipo_cartografico: false,
    tipo_hemerografico: false,
    tipo_documento_tecnico: false,
    // Otros
    finalidad: "",
    oficio: "",
    solicito_digital: false,
    solicito_fotocopias: false,
    solicito_copias: false,
    materiales: Array.from({ length: 5 }, () => ({ titulo: "", inventario: "" }))
});

onMounted(() => {
    signaturePad = new SignaturePad(canvas.value);
    ctx = attendedCanvas.value.getContext("2d");
});

function clearSignature() {
    signaturePad.clear();
}

function saveSignature() {
    if (!signaturePad.isEmpty()) {
        alert("Firma capturada correctamente ✅");
    } else {
        alert("Por favor, firme antes de guardar.");
    }
}

const signatures = {
    vidal: "/firmas/vidal.png",
    sanjuana: "/firmas/sanjuana.png",
    mirza: "/firmas/mirza.png",
    beto: "/firmas/beto.png",
};

function loadSignature() {
    const imgSrc = signatures[selectedPerson.value];
    if (!imgSrc) {
        ctx.clearRect(0, 0, attendedCanvas.value.width, attendedCanvas.value.height);
        return;
    }

    const img = new Image();
    img.src = imgSrc;
    img.onload = () => {
        ctx.clearRect(0, 0, attendedCanvas.value.width, attendedCanvas.value.height);
        ctx.drawImage(img, 0, 0, attendedCanvas.value.width, attendedCanvas.value.height);
    };
}



async function generarPDF() {
    if (signaturePad.isEmpty()) {
        return alert("Debe firmar antes de generar el PDF.");
    }

    const firmaConsultante = signaturePad.toDataURL("image/png");
    const firmaAtendio = attendedCanvas.value.toDataURL("image/png");

    const doc = new jsPDF({ orientation: "portrait", unit: "mm", format: "letter" });

    let y = 15;

    // LOGOS ENCABEZADO
    const logoIzq = new Image();
    logoIzq.src = "assets/escudo.png";
    const logoDer = new Image();
    logoDer.src = "assets/agqroo1.png";

    // Dibuja logos cuando estén cargados
    await new Promise((resolve) => {
        let loaded = 0;
        [logoIzq, logoDer].forEach(img => {
            img.onload = () => {
                loaded++;
                if (loaded === 2) resolve();
            };
        });
    });


    // Reducimos tamaño a algo institucional (30mm alto aprox.)
    const logoHeight = 30;
    const logoWidth = 30;

    /* Logo izquierda esquina superior
    doc.addImage(logoIzq, "PNG", 15, y, logoWidth, logoHeight);
    
    // Logo derecha esquina superior
    doc.addImage(logoDer, "PNG", 165, y, logoWidth, logoHeight);
*/
    // TEXTO CENTRAL
    doc.setFontSize(16);
    doc.text("Archivo General del Estado de Quintana Roo", 105, y + 12, { align: "center" });
    doc.setFontSize(12);
    doc.text("Formato de consulta y solicitud de reproducción", 105, y + 19, { align: "center" });
    doc.setFontSize(10);
    doc.text("Departamento de Biblioteca y Hemeroteca", 105, y + 25, { align: "center" });

    y += logoHeight + 10; // bajamos después de los logos y texto

    // FECHA Y FOLIO
    doc.setFontSize(10);
    doc.text(`Fecha de consulta: ${formData.value.fecha}`, 20, y);
    doc.text(`Folio: ${formData.value.folio}`, 140, y);
    y += 10;

    // DATOS DE IDENTIFICACIÓN
    doc.setFontSize(12);
    doc.text("Datos de Identificación", 20, y);
    doc.setLineWidth(0.5);
    doc.line(20, y + 2, 190, y + 2);
    y += 8;

    doc.setFontSize(10);
    doc.text(`Nombre: ${formData.value.nombre}`, 20, y);
    doc.text(`Edad: ${formData.value.edad}`, 140, y);
    y += 6;
    doc.text(`Teléfono: ${formData.value.telefono}`, 20, y);
    doc.text(`Procedencia: ${formData.value.procedencia}`, 140, y);
    y += 6;
    doc.text(`Correo: ${formData.value.correo}`, 20, y);
    y += 10;

    // TEMA
    doc.text(`Tema de consulta: ${formData.value.tema}`, 20, y);
    y += 10;

    // NIVEL DE ESTUDIOS
    const estudios = [];
    if (formData.value.estudio_basica) estudios.push("Básica");
    if (formData.value.estudio_secundaria) estudios.push("Secundaria");
    if (formData.value.estudio_bachillerato) estudios.push("Bachillerato");
    if (formData.value.estudio_licenciatura) estudios.push("Licenciatura");
    if (formData.value.estudio_maestria) estudios.push("Maestría");
    if (formData.value.estudio_doctorado) estudios.push("Doctorado");
    if (formData.value.estudio_posgrado) estudios.push("Posgrado");

    if (estudios.length) {
        doc.text(`Nivel de estudios: ${estudios.join(", ")}`, 20, y);
        y += 8;
    }

    // MATERIAL SOLICITADO
    const materiales = [];
    if (formData.value.mat_documentos) materiales.push("Documentos");
    if (formData.value.mat_libros) materiales.push("Libros");
    if (formData.value.mat_planos) materiales.push("Planos");
    if (formData.value.mat_publicaciones) materiales.push("Publicaciones periódicas");
    if (formData.value.mat_poe) materiales.push("Periódico Oficial del Estado");
    if (formData.value.mat_dof) materiales.push("Diario Oficial de la Federación");
    if (formData.value.mat_informes) materiales.push("Informes de Gobierno");

    if (materiales.length) {
        doc.text(`Material solicitado: ${materiales.join(", ")}`, 20, y);
        y += 8;
    }

    // OBJETIVOS
    const objetivos = [];
    if (formData.value.obj_tesis) objetivos.push("Tesis");
    if (formData.value.obj_investigacion) objetivos.push("Investigación");
    if (formData.value.obj_publicacion) objetivos.push("Publicación");
    if (formData.value.obj_exposicion) objetivos.push("Exposición");
    if (formData.value.obj_tarea) objetivos.push("Tarea");

    if (objetivos.length) {
        doc.text(`Objetivos de la información: ${objetivos.join(", ")}`, 20, y);
        y += 8;
    }

    // TIPO DE DOCUMENTO
    const tipos = [];
    if (formData.value.tipo_bibliografico) tipos.push("Bibliográfico");
    if (formData.value.tipo_cartografico) tipos.push("Cartográfico");
    if (formData.value.tipo_hemerografico) tipos.push("Hemerográfico");
    if (formData.value.tipo_documento_tecnico) tipos.push("Documento técnico");

    if (tipos.length) {
        doc.text(`Tipo de documento consultado: ${tipos.join(", ")}`, 20, y);
        y += 8;
    }

    // FINALIDAD
    doc.text("Finalidad de la consulta:", 20, y);
    y += 6;
    doc.text(doc.splitTextToSize(formData.value.finalidad, 170), 20, y);
    y += 12;
    doc.text(`Fecha y número de oficio: ${formData.value.oficio}`, 20, y);
    y += 15;

    // MATERIALES DETALLADOS
    doc.text("Material solicitado (detalle):", 20, y);
    y += 6;
    formData.value.materiales.forEach((mat, i) => {
        if (mat.titulo || mat.inventario) {
            doc.text(`${i + 1}. ${mat.titulo} - ${mat.inventario}`, 25, y);
            y += 5;
        }
    });
    y += 10;

    // FIRMAS
    doc.text("Firma del consultante:", 20, y);
    doc.addImage(firmaConsultante, "PNG", 20, y + 3, 60, 30);
    doc.text("Atendió y entregó:", 120, y);
    doc.addImage(firmaAtendio, "PNG", 120, y + 3, 60, 30);


    // 📌 Generar PDF en Blob en vez de Base64
    const pdfBlob = doc.output("blob");

    // 📤 Enviar al backend usando FormData (renombrado a payload para no chocar)
    const payload = new FormData();
    payload.append("archivo", pdfBlob, "consulta.pdf");
    payload.append("tipo", "formato de consulta");
    payload.append("nombre", "consulta");

    try {
        const response = await axios.post("/formularioconsulta", payload, {
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                "Accept": "application/json"
            }
        });

        alert("✅ PDF generado y guardado correctamente en el expediente");
        console.log("Registro creado:", response.data);

        if (response.data.url) {
            window.open(response.data.url, "_blank");
        }

        signaturePad.clear();
        ctx.clearRect(0, 0, attendedCanvas.value.width, attendedCanvas.value.height);

    } catch (error) {
        console.error("Error al guardar el PDF:", error.response?.data || error);
        alert("❌ Hubo un error al guardar el PDF.");
    }
}

</script>
