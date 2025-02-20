import Shepherd from "https://cdn.jsdelivr.net/npm/shepherd.js@13.0.0/dist/esm/shepherd.mjs";

const tour = new Shepherd.Tour({
    useModalOverlay: true,
    defaultStepOptions: {
      classes: 'sheperd-theme-arrows',
      scrollTo: true
    }
  });

tour.addStep({
    id: "body",
    title: "Bienvenue",
    text: "Bienvenido a la aplicación",
    attachTo:{
        element: "document.body",
        on: "center"
    },
    buttons: [
        {
            text: "Next",
            action: tour.next
        }
    ]
});

tour.addStep({
    id: "searchQuery",
    title: "Recherche",
    text: "Ca marche comme un moteur de recherche",
    attachTo:{
        element: "#searchQuery",
        on: "bottom"
    },
    buttons: [
        {
            text: "Next",
            action: tour.next
        }
    ]
});

tour.addStep({
    id: "stats",
    title:"Statistiques",
    text: "Les statistiques marche pas :P",
    attachTo:{
        element: "#stats",
        on: "bottom"
    },
    buttons: [
        {
            text: "Next",
            action: tour.next
        }
    ]
});

tour.addStep({
    id: "finito",
    title:"FINI",
    text: "Amusez vous bien",
    attachTo:{
        element: "document.body",
        on: "center"
    },
    buttons: [
        {
            text: "Finish",
            action: tour.next
        }
    ]
});

if(!localStorage.getItem('shepherd-tour')) {
    tour.start();
    localStorage.setItem('shepherd-tour', 'yes');
}
