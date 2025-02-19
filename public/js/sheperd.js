import Shepherd from "https://cdn.jsdelivr.net/npm/shepherd.js@13.0.0/dist/esm/shepherd.mjs";

const tour = new Shepherd.Tour({
    useModalOverlay: true,
    defaultStepOptions: {
      classes: 'shadow-md bg-purple-dark',
      scrollTo: true
    }
  });

tour.addStep({
    id: "body",
    text: "Bienvenido a la aplicación",
    attachTo:{
        element: "document.body",
        on: "center"
    },
    buttons: [
        {
            text: "Suivant",
            action: tour.next
        }
    ]
});

tour.addStep({
    id: "searchQuery",
    text: "Ca marche comme un moteur de recherche",
    attachTo:{
        element: "#searchQuery",
        on: "bottom"
    },
    buttons: [
        {
            text: "Suivant",
            action: tour.next
        }
    ]
});

tour.addStep({
    id: "stats",
    text: "Ca marche pas :P",
    attachTo:{
        element: "#stats",
        on: "bottom"
    },
    buttons: [
        {
            text: "FIN",
            action: tour.end
        }
    ]
});

tour.start();
