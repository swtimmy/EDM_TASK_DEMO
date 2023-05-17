import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

Livewire.on("formDone", (postId) => {
    $("html, body").animate(
        {
            scrollTop: $("#table-layout").offset().top - 50,
        },
        500
    );
});
