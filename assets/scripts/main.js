let fondSombre = document.querySelector("#fond-sombre");
let fenetre = document.querySelector("#fenetre");
let menuBurger = document.querySelector("#menuburger");

menuBurger.addEventListener("click", handleClickMenuBurger);

function handleClickMenuBurger() {
  fenetre.classList.remove("hidden");
  fenetre.classList.add("flex");
  fondSombre.classList.remove("hidden");
}

fondSombre.addEventListener("click", handleClickFond);

function handleClickFond() {
  fenetre.classList.add("hidden");
  fenetre.classList.remove("flex");
  fondSombre.classList.add("hidden");
}

// ========== RÉCUPÉRER LES ÉLÉMENTS ==========
const form = document.getElementById("quizForm");

if (form) {
  const timerSpan = document.getElementById("timer");
  const boutonValider = form.querySelector('button[type="submit"]');
  const reponseInputs = document.querySelectorAll('input[name="reponse"]');
  const feedbackZone = document.getElementById("feedbackZone");
  const bonneReponseId = form.dataset.bonneReponse;
  const bonTexte = form.dataset.bonTexte;

  // ========== TIMER ==========
  let tempsRestant = 15;
  let timerInterval = null;
  let aValide = false; // Le joueur a-t-il choisi une réponse ?
  let aChoisi = false; // Le feedback a-t-il déjà été affiché ?

  function demarrerTimer() {
    timerInterval = setInterval(function () {
      tempsRestant--;
      timerSpan.textContent = tempsRestant;

      if (tempsRestant <= 5) {
        timerSpan.style.color = "#ef4444";
      }

      if (tempsRestant <= 0) {
        clearInterval(timerInterval);
        form.action = "../process/next-question.php";
        form.submit(); //Timer écoulé -> soumission directe
      }
    }, 1000);
  }

  // ========== ACTIVER LE BOUTON AU CLIC ==========
  reponseInputs.forEach(function (input) {
    input.addEventListener("change", function () {
      if (aChoisi) return;
      aChoisi = true;

      // Activer le bouton
      boutonValider.disabled = false;
      boutonValider.classList.remove("opacity-50", "cursor-not-allowed");
      boutonValider.style.opacity = "1";
      boutonValider.style.cursor = "pointer";
    });
  });

  // ========== INTERCEPTER "VALIDER" → AFFICHER FEEDBACK ==========
  form.addEventListener("submit", function (event) {
    if (aValide) return; // déjà traité, on laisse passer
    event.preventDefault();
    aValide = true;
    clearInterval(timerInterval);

    // Empêcher de re-cliquer SANS désactiver (sinon la valeur n'est pas envoyée)
    reponseInputs.forEach(function (r) {
      r.style.pointerEvents = "none";
    });
    
    // Trouver la réponse choisie
    let reponseChoisie = null;
    reponseInputs.forEach(function (r) {
      if (r.checked) reponseChoisie = r.value;
    });

    // Afficher le feedback
    feedbackZone.classList.remove("hidden");
    feedbackZone.style.display = "block";

    if (reponseChoisie === bonneReponseId) {
      feedbackZone.className =
        "block text-center mt-4 p-4 rounded-xl text-lg font-bold";
      feedbackZone.style.backgroundColor = "#dcfce7";
      feedbackZone.style.color = "#166534";
      feedbackZone.textContent = "✅ C'est la bonne réponse!";
    } else {
      feedbackZone.className =
        "block text-center mt-4 p-4 rounded-xl text-lg font-bold";
      feedbackZone.style.backgroundColor = "#fee2e2";
      feedbackZone.style.color = "#991b1b";
      feedbackZone.textContent = "❌ Faux ! La bonne réponse : " + bonTexte;
    }

    // Attendre 2s puis soumettre
    setTimeout(function () {
      form.submit();
    }, 2000);
  });

  // ========== LANCER ==========
  demarrerTimer();
} //FIN du if (form)
