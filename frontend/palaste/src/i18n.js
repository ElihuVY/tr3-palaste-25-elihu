import { createI18n } from 'vue-i18n'
import fr from './locales/fr.json'
import es from './locales/es.json'

const i18n = createI18n({
  locale: 'fr', // Cambiar idioma aquí ('fr' o 'es')
  fallbackLocale: 'es',
  messages: {
    fr,
    es
  }
})

export default i18n
