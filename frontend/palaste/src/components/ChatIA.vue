<template>
  <div class="project-request-container">
    <h2 class="title">Demande de Projet de Soudure</h2>
    
    <form @submit.prevent="submitRequest" v-if="!requestSent" class="request-form">
      <!-- Section d'informations client -->
      <div class="client-info-section">
        <h3 class="section-title">📋 Informations du Client</h3>
        <div class="form-row">
          <div class="form-group">
            <label for="name">Nom complet:</label>
            <input type="text" id="name" v-model="form.name" required class="form-input">
          </div>
          
          <div class="form-group">
            <label for="phone">Téléphone:</label>
            <input type="tel" id="phone" v-model="form.phone" required class="form-input" placeholder="+34 123 456 789">
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group">
            <label for="email">Courriel:</label>
            <input type="email" id="email" v-model="form.email" required class="form-input">
          </div>
          
          <div class="form-group">
            <label for="address">Adresse (facultatif):</label>
            <input type="text" id="address" v-model="form.address" class="form-input" placeholder="Rue, numéro, ville, code postal">
          </div>
        </div>
      </div>
      
      <!-- Sélection du type de projet -->
      <div class="project-type-section">
        <h3 class="section-title">🔧 Type de Projet</h3>
        <div class="project-type-options">
          <button type="button" 
                  v-for="type in project_types" 
                  :key="type.value" 
                  @click="selectproject_type(type.value)"
                  :class="['type-option', { 'active': form.project_type === type.value }]">
            <span class="type-icon">{{ type.icon }}</span>
            {{ type.label }}
          </button>
        </div>
      </div>
      
      <!-- Options spécifiques selon le type de projet -->
      <div v-if="form.project_type" class="specific-options-section">
        <h3 class="section-title">⚙️ Détails du Projet</h3>
        
        <!-- Options pour les escaliers -->
        <div v-if="form.project_type === 'stairs'" class="options-group">
          <div class="form-row">
            <div class="form-group">
              <label for="stairs-type">Type d'escalier:</label>
              <select id="stairs-type" v-model="form.stairs.type" class="form-select">
                <option value="">Sélectionnez...</option>
                <option value="interior">Intérieur</option>
                <option value="exterior">Extérieur</option>
                <option value="industrial">Industriel</option>
                <option value="caracol">En colimaçon</option>
                <option value="recta">Droit</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="stairs-material">Matériau principal:</label>
              <select id="stairs-material" v-model="form.stairs.material" class="form-select">
                <option value="">Sélectionnez...</option>
                <option value="acero">Acier</option>
                <option value="inoxidable">Acier inoxydable</option>
                <option value="hierro">Fer forgé</option>
                <option value="mixta">Mixte (bois/métal)</option>
              </select>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label for="stairs-railings">Inclure des rampes?</label>
              <select id="stairs-railings" v-model="form.stairs.hasRailings" class="form-select">
                <option value="yes">Oui</option>
                <option value="no">Non</option>
                <option value="unsure">Je ne suis pas sûr</option>
              </select>
            </div>
            
            <div v-if="form.stairs.hasRailings === 'yes'" class="form-group">
              <label for="railings-style">Style de rampes:</label>
              <select id="railings-style" v-model="form.stairs.railingsStyle" class="form-select">
                <option value="">Sélectionnez...</option>
                <option value="modern">Moderne (lignes droites)</option>
                <option value="classic">Classique (motifs ornementaux)</option>
                <option value="industrial">Industriel (tuyaux apparents)</option>
                <option value="minimalist">Minimaliste (verre/acier)</option>
              </select>
            </div>
          </div>
        </div>
        
        <!-- Options pour les rampes -->
        <div v-if="form.project_type === 'railings'" class="options-group">
          <div class="form-row">
            <div class="form-group">
              <label for="railings-location">Emplacement:</label>
              <select id="railings-location" v-model="form.railings.location" class="form-select">
                <option value="">Sélectionnez...</option>
                <option value="balcony">Balcon</option>
                <option value="terrace">Terrasse</option>
                <option value="staircase">Escalier</option>
                <option value="window">Protection de fenêtre</option>
                <option value="pool">Autour de la piscine</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="railings-material">Matériau:</label>
              <select id="railings-material" v-model="form.railings.material" class="form-select">
                <option value="">Sélectionnez...</option>
                <option value="acero">Acier</option>
                <option value="inoxidable">Acier inoxydable</option>
                <option value="hierro">Fer forgé</option>
                <option value="aluminio">Aluminium</option>
              </select>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label for="railings-style">Style:</label>
              <select id="railings-style" v-model="form.railings.style" class="form-select">
                <option value="">Sélectionnez...</option>
                <option value="modern">Moderne</option>
                <option value="classic">Classique</option>
                <option value="custom">Design personnalisé</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="railings-height">Hauteur approximative (cm):</label>
              <input type="number" id="railings-height" v-model="form.railings.height" class="form-input" placeholder="Ex: 100">
            </div>
          </div>
        </div>
        
        <!-- Options pour les portes -->
        <div v-if="form.project_type === 'doors'" class="options-group">
          <div class="form-row">
            <div class="form-group">
              <label for="door-type">Type de porte:</label>
              <select id="door-type" v-model="form.doors.type" class="form-select">
                <option value="">Sélectionnez...</option>
                <option value="exterior">Porte extérieure</option>
                <option value="interior">Porte intérieure</option>
                <option value="garage">Porte de garage</option>
                <option value="security">Porte de sécurité</option>
                <option value="sliding">Coulissante</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="door-material">Matériau:</label>
              <select id="door-material" v-model="form.doors.material" class="form-select">
                <option value="">Sélectionnez...</option>
                <option value="acero">Acier</option>
                <option value="hierro">Fer</option>
                <option value="mixta">Mixte (bois/métal)</option>
              </select>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label for="door-style">Style:</label>
              <select id="door-style" v-model="form.doors.style" class="form-select">
                <option value="">Sélectionnez...</option>
                <option value="modern">Moderne</option>
                <option value="classic">Classique</option>
                <option value="industrial">Industriel</option>
                <option value="custom">Personnalisé</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="door-dimensions">Dimensions (largeur x hauteur en cm):</label>
              <input type="text" id="door-dimensions" v-model="form.doors.dimensions" class="form-input" placeholder="Ex: 90x210">
            </div>
          </div>
        </div>
        
        <!-- Options pour autres projets -->
        <div v-if="form.project_type === 'other'" class="options-group">
          <div class="form-group">
            <label for="other-type">Que souhaitez-vous?</label>
            <select id="other-type" v-model="form.other.type" class="form-select">
              <option value="">Sélectionnez...</option>
              <option value="structure">Structure métallique</option>
              <option value="furniture">Meuble en métal</option>
              <option value="art">Pièce artistique/décorative</option>
              <option value="repair">Réparation</option>
              <option value="custom">Projet personnalisé</option>
            </select>
          </div>
          
          <div v-if="form.other.type" class="form-group">
            <label for="other-details">Détails supplémentaires:</label>
            <textarea id="other-details" v-model="form.other.details" class="form-textarea" placeholder="Décrivez ce dont vous avez besoin..."></textarea>
          </div>
        </div>
      </div>
      
      <!-- Description du projet -->
      <div class="description-section">
        <h3 class="section-title">📝 Description du Projet</h3>
        
        <div class="form-group">
          <label for="description">Dites-nous en plus sur ce dont vous avez besoin:</label>
          <textarea id="description" v-model="form.description" required class="form-textarea" placeholder="Décrivez votre projet avec tous les détails importants..."></textarea>
          
          <div class="ai-assistant">
            <button type="button" @click="improveDescription" class="action-btn improve-btn" :disabled="isImproving">
              <span class="icon">✨</span> 
              {{ isImproving ? 'Génération...' : 'Améliorer la description avec IA' }}
            </button>
            
            <div v-if="aiSuggestions.length > 0" class="suggestions-box">
              <h4>Suggestions de l'IA:</h4>
              <div v-for="(suggestion, index) in aiSuggestions" :key="index" class="suggestion-item">
                <p>{{ suggestion }}</p>
                <button type="button" @click="applySuggestion(suggestion)" class="suggestion-btn">Utiliser cette suggestion</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Pièces jointes et envoi -->
      <div class="attachments-section">
        <h3 class="section-title">📎 Pièces jointes</h3>
        
        <div class="form-group">
          <label for="files">Joignez des photos, plans ou références:</label>
            <input type="file" id="files" multiple @change="handleFiles" class="file-input" accept="image/*,.pdf,.doc,.docx" aria-label="Joindre des fichiers (images, PDF, Word)">
            <span style="display:block; margin-top:0.5rem; color:#555; font-size:0.95rem;">
              Formats acceptés : images, PDF, Word. Sélectionnez ou glissez-déposez vos fichiers ici.
            </span>
          
          <div v-if="form.files.length > 0" class="file-preview">
            <div v-for="(file, index) in form.files" :key="index" class="file-item">
              <span class="file-icon">📄</span>
              <span class="file-name">{{ file.name }}</span>
              <button type="button" @click="removeFile(index)" class="remove-file-btn">×</button>
            </div>
          </div>
        </div>
        
      
        
        <div class="form-group">
          <label for="timeline">Quand avez-vous besoin du projet?</label>
          <select id="timeline" v-model="form.timeline" class="form-select">
            <option value="">Pas pressé</option>
            <option value="1-2 weeks">Dans 1-2 semaines</option>
            <option value="3-4 weeks">Dans 3-4 semaines</option>
            <option value="urgent">Urgent (dès que possible)</option>
            <option value="specific">Date spécifique</option>
          </select>
        </div>
      </div>
      
      <div class="form-actions">
        <button type="submit" class="action-btn submit-btn">
          <span class="icon">📨</span> Envoyer la Demande
        </button>
      </div>
    </form>
    
    <!-- Écran de confirmation de la demande -->
    <div v-else class="confirmation-screen">
      <div class="confirmation-content">
        <div class="success-icon">✅</div>
        <h3 class="confirmation-title">Demande envoyée avec succès!</h3>
        
        <div class="request-summary">
          <h4>Résumé de votre demande:</h4>
          <p><strong>Type de projet:</strong> {{ getproject_typeLabel(savedRequest.project_type) }}</p>
          <p><strong>Nom:</strong> {{ savedRequest.name }}</p>
          <p><strong>Contact:</strong> {{ savedRequest.phone }} | {{ savedRequest.email }}</p>
          <p v-if="savedRequest.address"><strong>Adresse:</strong> {{ savedRequest.address }}</p>
          
          <!-- Détails spécifiques selon le type de projet -->
          <div v-if="savedRequest.project_type === 'stairs'">
            <p><strong>Type d'escalier:</strong> {{ savedRequest.stairs.type || 'Non spécifié' }}</p>
            <p><strong>Matériau:</strong> {{ savedRequest.stairs.material || 'Non spécifié' }}</p>
            <p v-if="savedRequest.stairs.hasRailings === 'yes'"><strong>Style de rampes:</strong> {{ savedRequest.stairs.railingsStyle || 'Non spécifié' }}</p>
          </div>
          
          <div v-else-if="savedRequest.project_type === 'railings'">
            <p><strong>Emplacement:</strong> {{ savedRequest.railings.location || 'Non spécifié' }}</p>
            <p><strong>Matériau:</strong> {{ savedRequest.railings.material || 'Non spécifié' }}</p>
            <p><strong>Style:</strong> {{ savedRequest.railings.style || 'Non spécifié' }}</p>
            <p v-if="savedRequest.railings.height"><strong>Hauteur:</strong> {{ savedRequest.railings.height }} cm</p>
          </div>
          
          <div v-else-if="savedRequest.project_type === 'doors'">
            <p><strong>Type de porte:</strong> {{ savedRequest.doors.type || 'Non spécifié' }}</p>
            <p><strong>Matériau:</strong> {{ savedRequest.doors.material || 'Non spécifié' }}</p>
            <p><strong>Style:</strong> {{ savedRequest.doors.style || 'Non spécifié' }}</p>
            <p v-if="savedRequest.doors.dimensions"><strong>Dimensions:</strong> {{ savedRequest.doors.dimensions }}</p>
          </div>
          
          <div v-else-if="savedRequest.project_type === 'other'">
            <p><strong>Type:</strong> {{ savedRequest.other.type || 'Non spécifié' }}</p>
            <p v-if="savedRequest.other.details"><strong>Détails:</strong> {{ savedRequest.other.details }}</p>
          </div>
          
          <p><strong>Description:</strong> {{ savedRequest.description }}</p>
          <p v-if="savedRequest.budget"><strong>Budget:</strong> {{ savedRequest.budget }}</p>
          <p v-if="savedRequest.timeline"><strong>Délai:</strong> {{ savedRequest.timeline }}</p>
          <p v-if="savedRequest.files.length > 0"><strong>Fichiers joints:</strong> {{ savedRequest.files.length }}</p>
        </div>
        
        <p class="confirmation-message">
          Nous avons reçu votre demande et notre équipe est en train de l'examiner. 
          Nous vous contacterons dans un délai de 24 à 48 heures pour discuter des détails 
          et vous fournir un devis détaillé. Vous pouvez vous inscrire et voir vos commandes et demandes dans votre profil.
        </p>
        
        <div class="confirmation-actions">
          <button @click="resetForm" class="action-btn submit-btn">
            <span class="icon">➕</span> Envoyer une autre demande
          </button>
          <button @click="downloadSummary" class="action-btn download-btn">
            <span class="icon">📥</span> Télécharger le résumé
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script scoped>
import { submitProjectRequest } from '@/comunication_manager';

export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        phone: '',
        address: '',
        project_type: '',
        description: '',
        budget: '',
        timeline: '',
        files: [],
        stairs: { type: '', material: '', hasRailings: 'yes', railingsStyle: '' },
        railings: { location: '', material: '', style: '', height: '' },
        doors: { type: '', material: '', style: '', dimensions: '' },
        other: { type: '', details: '' }
      },
      savedRequest: {},
      requestSent: false,
      isImproving: false,
      aiSuggestions: [],
      project_types: [
        { value: 'stairs', label: 'Escaliers', icon: '📶' },
        { value: 'railings', label: 'Rampes', icon: '🚧' },
        { value: 'doors', label: 'Portes', icon: '🚪' },
        { value: 'other', label: 'Autre projet', icon: '🔩' }
      ],
      errorMessage: null
    };
  },
  methods: {
    getproject_typeLabel(value) {
      const type = this.project_types.find(t => t.value === value);
      return type ? type.label : 'Non spécifié';
    },
    selectproject_type(type) {
      this.form.project_type = type;
      this.form.stairs = { type: '', material: '', hasRailings: 'yes', railingsStyle: '' };
      this.form.railings = { location: '', material: '', style: '', height: '' };
      this.form.doors = { type: '', material: '', style: '', dimensions: '' };
      this.form.other = { type: '', details: '' };
    },
    handleFiles(event) {
      this.form.files = Array.from(event.target.files);
    },
    removeFile(index) {
      this.form.files.splice(index, 1);
    },
    async improveDescription() {
      if (!this.form.description.trim()) {
        alert('Veuillez écrire une description initiale pour que l\'IA puisse l\'améliorer');
        return;
      }

      this.isImproving = true;
      this.aiSuggestions = [];

      try {
        // Simulación de generación de sugerencias con IA
        await new Promise(resolve => setTimeout(resolve, 1500));

        if (this.form.project_type === 'stairs') {
          this.aiSuggestions = [
            `Escalier en ${this.form.stairs.material || 'métal'} pour ${this.form.stairs.type || 'intérieur/extérieur'}. ` +
            `Comprend ${this.form.stairs.hasRailings === 'yes' ? 'rampes style ' + (this.form.stairs.railingsStyle || 'moderne') : 'sans rampes'}. ` +
            `Besoin d'un design ${this.form.stairs.type === 'caracol' ? 'en spirale optimisant l\'espace' : 'fonctionnel et résistant'}.`,
            `Projet d'escalier métallique avec les caractéristiques suivantes:\n` +
            `- Type: ${this.form.stairs.type || 'à définir'}\n` +
            `- Matériau principal: ${this.form.stairs.material || 'acier/inoxydable'}\n` +
            `- Rampes: ${this.form.stairs.hasRailings === 'yes' ? 'Oui, style ' + (this.form.stairs.railingsStyle || 'à choisir') : 'Non'}\n` +
            `- Exigences supplémentaires: ${this.form.description || 'aucune spécifiée'}`
          ];
        } else if (this.form.project_type === 'railings') {
          this.aiSuggestions = [
            `Rambarde en ${this.form.railings.material || 'métal'} pour ${this.form.railings.location || 'emplacement à définir'}. ` +
            `Style ${this.form.railings.style || 'moderne'}, hauteur approximative ${this.form.railings.height || '100'} cm. ` +
            `Besoin qu'elle soit ${this.form.railings.location === 'pool' ? 'résistante à humidité et au design sécurisé' : 'esthétique et fonctionnelle'}.`,
            `Spécifications pour rambarde:\n` +
            `- Emplacement: ${this.form.railings.location || 'à déterminer'}\n` +
            `- Matériau: ${this.form.railings.material || 'acier/inoxydable'}\n` +
            `- Style: ${this.form.railings.style || 'moderne/classique'}\n` +
            `- Hauteur: ${this.form.railings.height || '100'} cm\n` +
            `- Détails supplémentaires: ${this.form.description || 'aucun'}`
          ];
        } else if (this.form.project_type === 'doors') {
          this.aiSuggestions = [
            `Porte en ${this.form.doors.material || 'métal'} pour ${this.form.doors.type || 'usage à définir'}. ` +
            `Style ${this.form.doors.style || 'moderne'}, dimensions ${this.form.doors.dimensions || 'standard'}. ` +
            `Exigences: ${this.form.doors.type === 'security' ? 'haute sécurité et résistance' : 'design attrayant et fonctionnalité'}.`,
            `Détails pour porte métallique:\n` +
            `- Type: ${this.form.doors.type || 'extérieur/intérieur'}\n` +
            `- Matériau: ${this.form.doors.material || 'acier/fer'}\n` +
            `- Style: ${this.form.doors.style || 'moderne/classique'}\n` +
            `- Dimensions: ${this.form.doors.dimensions || 'à déterminer'}\n` +
            `- Considérations spéciales: ${this.form.description || 'aucune'}`
          ];
        } else {
          this.aiSuggestions = [
            `Projet de soudure personnalisé. Type: ${this.form.other.type || 'structure/meuble/art'}. ` +
            `Détails: ${this.form.other.details || 'à spécifier'}. ` +
            `Exigences techniques: ${this.form.description || 'aucune indiquée'}.`,
            `Description détaillée du projet:\n` +
            `- Type: ${this.form.other.type || 'personnalisé'}\n` +
            `- Matériaux préférés: ${this.form.description.includes('matériau') ? '' : 'à déterminer'}\n` +
            `- Dimensions approximatives: ${this.form.description.includes('mesure') ? '' : 'non spécifiées'}\n` +
            `- Usage/fonction: ${this.form.other.details || 'à définir'}\n` +
            `- Détails supplémentaires: ${this.form.description || 'aucun'}`
          ];
        }
      } catch (error) {
        console.error('Erreur lors de l\'amélioration de la description:', error);
        alert('Une erreur est survenue lors de la génération des suggestions. Veuillez réessayer.');
      } finally {
        this.isImproving = false;
      }
    },
    applySuggestion(suggestion) {
      this.form.description = suggestion;
      this.aiSuggestions = [];
    },
    async submitRequest() {
      if (!this.form.project_type) {
        alert('Veuillez sélectionner le type de projet');
        return;
      }
      this.errorMessage = null;
      this.isSubmitting = true;

      const formData = new FormData();
      formData.append('name', this.form.name);
      formData.append('email', this.form.email);
      formData.append('phone', this.form.phone);
      formData.append('address', this.form.address);
      formData.append('project_type', this.form.project_type);
      formData.append('description', this.form.description);
      formData.append('budget', this.form.budget);
      formData.append('timeline', this.form.timeline);
      formData.append(this.form.project_type, JSON.stringify(this.form[this.form.project_type]));
      this.form.files.forEach((file, index) => {
        formData.append(`files[${index}]`, file);
      });

      try {
        const data = await submitProjectRequest(formData);
        this.savedRequest = JSON.parse(JSON.stringify(this.form));
        this.requestSent = true;
        console.log('Demande envoyée:', this.savedRequest);
      } catch (error) {
        this.errorMessage = error.message;
      } finally {
        this.isSubmitting = false;
      }
    },
    resetForm() {
      this.form = {
        name: '',
        email: '',
        phone: '',
        address: '',
        project_type: '',
        description: '',
        budget: '',
        timeline: '',
        files: [],
        stairs: { type: '', material: '', hasRailings: 'yes', railingsStyle: '' },
        railings: { location: '', material: '', style: '', height: '' },
        doors: { type: '', material: '', style: '', dimensions: '' },
        other: { type: '', details: '' }
      };
      this.requestSent = false;
      this.aiSuggestions = [];
    },
    async downloadSummary() {
      // Import jspdf dynamically to avoid SSR issues
      const jsPDF = (await import('jspdf')).default;
      
      // Create new PDF document
      const doc = new jsPDF();
      
      // Add PALASTE logo/header
      doc.setFontSize(22);
      doc.setTextColor(66, 185, 131); // Green color
      doc.text('PALASTE', 105, 20, { align: 'center' });
      
      // Add request details
      doc.setFontSize(14);
      doc.setTextColor(0);
      doc.text('RÉSUMÉ DE LA DEMANDE', 105, 35, { align: 'center' });
      
      // Set normal text format
      doc.setFontSize(12);
      doc.setTextColor(60, 60, 60);
      
      let y = 50;
      const leftMargin = 20;
      
      // Add client info
      doc.text(`Client: ${this.savedRequest.name}`, leftMargin, y);
      y += 10;
      doc.text(`Contact: ${this.savedRequest.phone} | ${this.savedRequest.email}`, leftMargin, y);
      y += 10;
      if (this.savedRequest.address) {
        doc.text(`Adresse: ${this.savedRequest.address}`, leftMargin, y);
        y += 10;
      }
      
      // Add project details
      doc.text(`Type de projet: ${this.getproject_typeLabel(this.savedRequest.project_type)}`, leftMargin, y);
      y += 15;
      
      // Add specific project details based on type
      if (this.savedRequest.project_type === 'stairs') {
        doc.text('Détails de l\'escalier:', leftMargin, y);
        y += 8;
        doc.text(`• Type: ${this.savedRequest.stairs.type || 'Non spécifié'}`, leftMargin + 5, y);
        y += 8;
        doc.text(`• Matériau: ${this.savedRequest.stairs.material || 'Non spécifié'}`, leftMargin + 5, y);
        y += 8;
        if (this.savedRequest.stairs.hasRailings === 'yes') {
          doc.text(`• Style de rampes: ${this.savedRequest.stairs.railingsStyle || 'Non spécifié'}`, leftMargin + 5, y);
          y += 8;
        }
      } else if (this.savedRequest.project_type === 'railings') {
        doc.text('Détails des rampes:', leftMargin, y);
        y += 8;
        doc.text(`• Emplacement: ${this.savedRequest.railings.location || 'Non spécifié'}`, leftMargin + 5, y);
        y += 8;
        doc.text(`• Matériau: ${this.savedRequest.railings.material || 'Non spécifié'}`, leftMargin + 5, y);
        y += 8;
        doc.text(`• Style: ${this.savedRequest.railings.style || 'Non spécifié'}`, leftMargin + 5, y);
        y += 8;
        if (this.savedRequest.railings.height) {
          doc.text(`• Hauteur: ${this.savedRequest.railings.height} cm`, leftMargin + 5, y);
          y += 8;
        }
      } else if (this.savedRequest.project_type === 'doors') {
        doc.text('Détails de la porte:', leftMargin, y);
        y += 8;
        doc.text(`• Type: ${this.savedRequest.doors.type || 'Non spécifié'}`, leftMargin + 5, y);
        y += 8;
        doc.text(`• Matériau: ${this.savedRequest.doors.material || 'Non spécifié'}`, leftMargin + 5, y);
        y += 8;
        doc.text(`• Style: ${this.savedRequest.doors.style || 'Non spécifié'}`, leftMargin + 5, y);
        y += 8;
        if (this.savedRequest.doors.dimensions) {
          doc.text(`• Dimensions: ${this.savedRequest.doors.dimensions}`, leftMargin + 5, y);
          y += 8;
        }
      }
      
      y += 10;
      
      // Add description with word wrap
      if (this.savedRequest.description) {
        doc.text('Description:', leftMargin, y);
        y += 8;
        const splitDescription = doc.splitTextToSize(this.savedRequest.description, 170);
        doc.text(splitDescription, leftMargin, y);
        y += splitDescription.length * 7;
      }
      
      // Add footer
      doc.setFontSize(10);
      doc.setTextColor(128, 128, 128);
      doc.text('PALASTE - Services de Soudure Professionnels', 105, 280, { align: 'center' });
      
      // Save the PDF
      doc.save('PALASTE-demande.pdf');
    }
  }
};
</script>

<style scoped>
.project-request-container {
  max-width: 900px;
  margin: 1rem auto;
  padding: 1rem;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.title {
  text-align: center;
  color: #2c3e50;
  margin-bottom: 1.5rem;
  font-size: 1.5rem;
  padding: 0 1rem;
}

@media (min-width: 768px) {
  .project-request-container {
    margin: 2rem auto;
    padding: 2rem;
    border-radius: 12px;
  }

  .title {
    font-size: 2rem;
    margin-bottom: 2rem;
  }
}

.section-title {
  color: #3a5169;
  margin: 1.5rem 0 1rem;
  padding-bottom: 0.5rem;
  border-bottom: 2px solid #e1e5eb;
  font-size: 1.3rem;
}

.request-form {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.form-row {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  margin-bottom: 1rem;
}

@media (min-width: 640px) {
  .form-row {
    flex-direction: row;
    gap: 1.5rem;
  }
}

.form-group {
  flex: 1;
  min-width: 0; /* Para evitar desbordamiento en móviles */
}

.form-input, .form-textarea, .form-select {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #ddd;
  border-radius: 6px;
  font-size: 0.95rem;
  margin-top: 0.25rem;
}

@media (min-width: 768px) {
  .form-input, .form-textarea, .form-select {
    padding: 0.8rem 1rem;
    font-size: 1rem;
  }
}

.form-input:focus, .form-textarea:focus, .form-select:focus {
  border-color: #42b983;
  outline: none;
  box-shadow: 0 0 0 3px rgba(66, 185, 131, 0.2);
}

.form-textarea {
  min-height: 150px;
  resize: vertical;
}

.form-select {
  appearance: none;
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right 0.8rem center;
  background-size: 1rem;
}

.project-type-options {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 0.75rem;
  margin-top: 0.75rem;
}

@media (min-width: 768px) {
  .project-type-options {
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
  }
}

.type-option {
  padding: 1rem 0.75rem;
  min-height: 80px;
  font-size: 0.9rem;
}

@media (min-width: 768px) {
  .type-option {
    padding: 1.5rem 1rem;
    font-size: 1rem;
  }
}

.type-option {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 1.5rem 1rem;
  border: 2px solid #e1e5eb;
  border-radius: 8px;
  background-color: white;
  cursor: pointer;
  transition: all 0.3s ease;
  text-align: center;
}

.type-option:hover {
  border-color: #42b983;
  transform: translateY(-3px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.type-option.active {
  border-color: #42b983;
  background-color: #f0faf5;
  font-weight: 500;
}

.type-icon {
  font-size: 1.8rem;
  margin-bottom: 0.5rem;
}

.file-input {
  width: 100%;
  padding: 1rem 0.5rem;
  border: 1px dashed #ccc;
  border-radius: 8px;
  background-color: #f8f9fa;
  touch-action: manipulation;
}

.file-input:hover {
  border-color: #42b983;
}

.file-preview {
  margin-top: 0.8rem;
}

.file-item {
  display: flex;
  align-items: center;
  padding: 0.75rem;
  background-color: #f0f0f0;
  border-radius: 6px;
  margin-bottom: 0.5rem;
}

.file-icon {
  margin-right: 0.8rem;
  font-size: 1.2rem;
}

.file-name {
  flex: 1;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.remove-file-btn {
  background: none;
  border: none;
  color: #ff6b6b;
  font-size: 1.2rem;
  cursor: pointer;
  padding: 0.5rem 0.75rem;
  min-width: 44px;
  min-height: 44px;
}

.ai-assistant {
  margin-top: 1rem;
}

.suggestions-box {
  margin-top: 1rem;
  padding: 1rem;
  background-color: #f8f9fa;
  border-radius: 8px;
  border: 1px solid #e1e5eb;
}

.suggestions-box h4 {
  margin-top: 0;
  color: #3a5169;
  font-size: 1rem;
}

.suggestion-item {
  padding: 0.75rem;
  margin: 0.5rem 0;
  background-color: white;
  border-radius: 6px;
  border-left: 3px solid #42b983;
  font-size: 0.9rem;
}

@media (min-width: 768px) {
  .suggestion-item {
    padding: 1rem;
    font-size: 1rem;
  }
}

.suggestion-btn {
  margin-top: 0.5rem;
  padding: 0.4rem 0.8rem;
  background-color: #f0faf5;
  border: 1px solid #42b983;
  border-radius: 4px;
  color: #42b983;
  font-size: 0.9rem;
  cursor: pointer;
  transition: all 0.2s ease;
}

.suggestion-btn:hover {
  background-color: #42b983;
  color: white;
}

.action-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  width: 100%;
  padding: 0.75rem;
  margin-top: 0.5rem;
  border: none;
  border-radius: 8px;
  font-size: 0.95rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
  touch-action: manipulation;
}

@media (min-width: 768px) {
  .action-btn {
    width: auto;
    padding: 0.8rem 1.5rem;
    margin-top: 0;
    font-size: 1rem;
  }
}

.action-btn .icon {
  font-size: 1.2rem;
}

.action-btn:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.action-btn:not(:disabled):hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.submit-btn {
  background-color: #42b983;
  color: white;
}

.submit-btn:hover:not(:disabled) {
  background-color: #369f6e;
}

.improve-btn {
  background-color: #647eff;
  color: white;
}

.improve-btn:hover:not(:disabled) {
  background-color: #4d6bff;
}

.download-btn {
  background-color: #6c757d;
  color: white;
}

.download-btn:hover:not(:disabled) {
  background-color: #5a6268;
}

.form-actions, .confirmation-actions {
  display: flex;
  gap: 1rem;
  justify-content: center;
  margin-top: 2rem;
}

.confirmation-screen {
  text-align: center;
  padding: 2rem;
}

.confirmation-content {
  padding: 1.5rem;
  margin: 1rem;
}

@media (min-width: 768px) {
  .confirmation-content {
    padding: 2.5rem;
    margin: 0 auto;
  }
}

.success-icon {
  font-size: 3.5rem;
  color: #42b983;
  margin-bottom: 1.5rem;
}

.confirmation-title {
  color: #2c3e50;
  margin-bottom: 1.5rem;
  font-size: 1.8rem;
}

.request-summary {
  text-align: left;
  background-color: #f8f9fa;
  padding: 1.5rem;
  border-radius: 8px;
  margin: 2rem 0;
}

.request-summary h4 {
  margin-top: 0;
  color: #2c3e50;
  border-bottom: 1px solid #ddd;
  padding-bottom: 0.5rem;
}

.request-summary p {
  margin: 0.5rem 0;
}

.confirmation-message {
  color: #555;
  line-height: 1.6;
  margin-bottom: 2rem;
  font-size: 1.1rem;
}

@media (max-width: 768px) {
  .project-request-container {
    padding: 1rem;
    margin: 1rem;
  }
  
  .form-row {
    flex-direction: column;
    gap: 1rem;
  }
  
  .project-type-options {
    grid-template-columns: 1fr 1fr;
  }
  
  .form-actions, .confirmation-actions {
    flex-direction: column;
  }
  
  .action-btn {
    width: 100%;
  }
}

@media (max-width: 480px) {
  .project-type-options {
    grid-template-columns: 1fr;
  }
  
  .confirmation-content {
    padding: 1.5rem;
  }
}

/* Mejoras táctiles pour mobile */
@media (max-width: 768px) {
  input, select, textarea, button {
    font-size: 16px !important; /* Previene zoom en iOS */
  }

  .type-option, .action-btn, .suggestion-btn {
    min-height: 44px; /* Altura mínima para elementos táctiles */
  }

  .file-item {
    padding: 0.75rem;
  }

  .remove-file-btn {
    padding: 0.5rem 0.75rem;
    min-width: 44px;
    min-height: 44px;
  }
}
</style>