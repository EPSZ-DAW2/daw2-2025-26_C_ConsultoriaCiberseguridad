<!-- Initial Banner (Old Design restored) -->
<div id="cookie-banner" class="cookie-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
    <div class="cookie-content bg-light p-4 rounded shadow-lg" style="max-width: 800px; width: 90%; margin: 20px;">
        <h3 class="fw-bold mb-3">Aceptación de Cookies</h3>
        <p class="mb-4">
            ¡Hola! En nuestra web usamos cookies propias y de terceros, incluidos los servicios de terceros proveedores, 
            para analizar el uso que haces de ella y mostrarte anuncios personalizados según tu perfil de navegación.
            <br><br>
            Puedes aceptarlas para seguir navegando, rechazarlas, o bien consultarlas para conocerlas en detalle en nuestra <a href="<?= \yii\helpers\Url::to(['/site/politica-privacidad']) ?>">Política de Privacidad</a>.
        </p>
        
        <div class="d-flex flex-column flex-md-row gap-3 justify-content-between">
            <button id="banner-reject-cookies" class="btn btn-danger flex-grow-1" style="background-color: #d32f2f; border-color: #d32f2f;">Rechazar todas las cookies</button>
            <button id="banner-config-cookies" class="btn btn-warning text-white flex-grow-1" style="background-color: #7cb342; border-color: #7cb342;">Configuración de cookies</button>
            <button id="banner-accept-cookies" class="btn btn-primary flex-grow-1" style="background-color: #0d47a1; border-color: #0d47a1;">Aceptar todas las cookies</button>
        </div>
    </div>
</div>

<!-- Configuration Modal -->
<div class="modal fade" id="cookieConfigModal" tabindex="-1" aria-labelledby="cookieConfigModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-bold" id="cookieConfigModalLabel">Panel de Configuración de Cookies</h5>
                <button type="button" class="close-modal-btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="small text-muted mb-4">
                    Este panel le permite configurar sus preferencias de consentimiento para las tecnologías de seguimiento que utilizamos.
                </p>

                <!-- Helper Buttons Top Right -->
                <div class="d-flex justify-content-end mb-3 gap-2">
                    <button class="btn btn-sm btn-outline-danger" id="modal-reject-all">Rechazar Todo</button>
                    <button class="btn btn-sm btn-outline-primary" id="modal-accept-all">Aceptar Todo</button>
                </div>

                <div class="accordion" id="cookiesAccordion">
                    
                    <!-- Technical Cookies -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTechnical">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTechnical" aria-expanded="true" aria-controls="collapseTechnical">
                                <div class="d-flex justify-content-between w-100 me-3 align-items-center">
                                    <span>Cookies técnicas (Estrictamente necesarias)</span>
                                    <span class="badge bg-success">Siempre activas</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseTechnical" class="accordion-collapse collapse show" aria-labelledby="headingTechnical" data-bs-parent="#cookiesAccordion">
                            <div class="accordion-body small text-muted">
                                Estas cookies son necesarias para que el sitio web funcione y no se pueden desactivar en nuestros sistemas. Usualmente están configuradas para responder a acciones hechas por usted para recibir servicios, como ajustar sus preferencias de privacidad, iniciar sesión en el sitio, o llenar formularios.
                            </div>
                        </div>
                    </div>

                    <!-- Preferences Cookies -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingPreferences">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePreferences" aria-expanded="false" aria-controls="collapsePreferences">
                                <div class="d-flex justify-content-between w-100 me-3 align-items-center">
                                    <span>Cookies de preferencias o personalización</span>
                                    <!-- Custom Toggle Switch -->
                                    <div class="form-check form-switch" style="margin-right: -10px;"> <!-- Negative margin to fix alignment if needed -->
                                        <input class="form-check-input cookie-toggle" type="checkbox" id="togglePreferences">
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapsePreferences" class="accordion-collapse collapse" aria-labelledby="headingPreferences" data-bs-parent="#cookiesAccordion">
                            <div class="accordion-body small text-muted">
                                Permiten recordar información para que el usuario acceda al servicio con determinadas características que pueden diferenciar su experiencia de la de otros usuarios (idioma, número de resultados, aspecto, etc.).
                            </div>
                        </div>
                    </div>

                    <!-- Analytics Cookies -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingAnalytics">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAnalytics" aria-expanded="false" aria-controls="collapseAnalytics">
                                <div class="d-flex justify-content-between w-100 me-3 align-items-center">
                                    <span>Cookies de análisis o medición</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input cookie-toggle" type="checkbox" id="toggleAnalytics">
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseAnalytics" class="accordion-collapse collapse" aria-labelledby="headingAnalytics" data-bs-parent="#cookiesAccordion">
                            <div class="accordion-body small text-muted">
                                Nos permiten el seguimiento y análisis del comportamiento de los usuarios en el sitio web (medición de actividad, elaboración de perfiles de navegación) para introducir mejoras.
                            </div>
                        </div>
                    </div>

                    <!-- Marketing Cookies -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingMarketing">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMarketing" aria-expanded="false" aria-controls="collapseMarketing">
                                <div class="d-flex justify-content-between w-100 me-3 align-items-center">
                                    <span>Cookies de Publicidad Comportamental</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input cookie-toggle" type="checkbox" id="toggleMarketing">
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseMarketing" class="accordion-collapse collapse" aria-labelledby="headingMarketing" data-bs-parent="#cookiesAccordion">
                            <div class="accordion-body small text-muted">
                                Almacenan información del comportamiento de los usuarios obtenida a través de la observación continuada de sus hábitos de navegación, lo que permite desarrollar un perfil específico para mostrar publicidad en función del mismo.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer bg-light justify-content-between">
                <div>
                   <!-- Optional: Link to detailed list or more info -->
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-secondary" id="modal-save-preferences">Guardar preferencias</button>
                    <button type="button" class="btn btn-primary" id="modal-accept-all-btn">Aceptar todo</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const banner = document.getElementById("cookie-banner");
    // We need to wait for Bootstrap to be loaded. Yii2 template loads it via AppAsset/scripts.
    // If simple-datatables is causing conflict or if bootstrap isn't available immediately, we might need a small delay or check.
    // Assuming Bootstrap 5 is loaded as per main layout.

    const cookieModalEl = document.getElementById('cookieConfigModal');
    let cookieModal; // Instance to be created

    function initModal() {
        if (typeof bootstrap !== 'undefined') {
            cookieModal = new bootstrap.Modal(cookieModalEl);
        } else {
            console.warn("Bootstrap not loaded yet?");
            // Retry/Fallbock logic if needed, but standard Yii2 setup should be fine or we wait for window load.
        }
    }
    
    // Attempt init
    initModal();
    // Re-attempt on window load just in case script runs before bootstrap bundle
    window.addEventListener('load', initModal);


    // Check stored consent
    const storedConsent = localStorage.getItem("cookieConsent");
    if (!storedConsent) {
        banner.style.display = "block";
    } else {
        // If needed, we could load the toggles state here based on storedConsent json
    }

    // --- Banner Actions ---
    
    document.getElementById("banner-accept-cookies").addEventListener("click", function() {
        saveConsent({ technical: true, preferences: true, analytics: true, marketing: true });
        banner.style.display = "none";
    });

    document.getElementById("banner-reject-cookies").addEventListener("click", function() {
        saveConsent({ technical: true, preferences: false, analytics: false, marketing: false });
        banner.style.display = "none";
    });

    document.getElementById("banner-config-cookies").addEventListener("click", function() {
        if(cookieModal) {
            cookieModal.show();
            banner.style.display = "none"; // Hide banner when opening modal? Or keep it? Usually hide.
        } else {
            // Fallback if bootstrap JS failed
            alert("No se pudo cargar el modal de configuración.");
        }
    });


    // --- Modal Actions ---

    // Top Right helpers
    document.getElementById("modal-reject-all").addEventListener("click", function() {
        setToggles(false);
    });
    document.getElementById("modal-accept-all").addEventListener("click", function() {
        setToggles(true);
    });

    // Bottom Buttons
    document.getElementById("modal-accept-all-btn").addEventListener("click", function() {
        setToggles(true);
        saveModalPreferences(); 
    });

    document.getElementById("modal-save-preferences").addEventListener("click", function() {
        saveModalPreferences();
    });

    
    // --- Logic ---

    function setToggles(state) {
        document.getElementById("togglePreferences").checked = state;
        document.getElementById("toggleAnalytics").checked = state;
        document.getElementById("toggleMarketing").checked = state;
    }

    function saveModalPreferences() {
        const consent = {
            technical: true,
            preferences: document.getElementById("togglePreferences").checked,
            analytics: document.getElementById("toggleAnalytics").checked,
            marketing: document.getElementById("toggleMarketing").checked
        };
        saveConsent(consent);
        if(cookieModal) cookieModal.hide();
        banner.style.display = "none";
    }

    function saveConsent(consentObj) {
        localStorage.setItem("cookieConsent", JSON.stringify(consentObj));
        console.log("Consent saved:", consentObj);
        // Here you would trigger actual GTM/Scripts enabling code
    }
});
</script>
