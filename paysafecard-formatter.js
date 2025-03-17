document.addEventListener("DOMContentLoaded", () => {
  // Sélectionner le champ de code Paysafecard
  const paysafecardInput = document.getElementById("paysafecard-code")

  if (paysafecardInput) {
    // Ajouter un écouteur d'événement pour formater le code pendant la saisie
    paysafecardInput.addEventListener("input", (e) => {
      // Récupérer la valeur actuelle et supprimer tous les caractères non numériques
      let value = e.target.value.replace(/[^\d]/g, "")

      // Limiter à 16 chiffres
      if (value.length > 16) {
        value = value.slice(0, 16)
      }

      // Formater avec des tirets tous les 4 chiffres
      let formattedValue = ""
      for (let i = 0; i < value.length; i++) {
        if (i > 0 && i % 4 === 0) {
          formattedValue += "-"
        }
        formattedValue += value[i]
      }

      // Mettre à jour la valeur du champ
      e.target.value = formattedValue
    })
  }
})

