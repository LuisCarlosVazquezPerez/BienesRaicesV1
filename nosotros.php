<?php
   include '../bienesraices/includes/templates/header.php'
?>

    <main class="contenedor seccion">
        <h1>Conoce sobre nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote> <!--blockquote es para contenido citado-->
                <p>Lorem ipsum dolorExplicabo corporis libero molestiae ad natus! Consectetur hic quam numquam magni
                    eveniet
                    aliquam aspernaturem ipsum dolor sit amet consectetur adipisicing elit. Repellendus et magni illum
                    eaque vitae alias
                    esse! Explicabo corporis libero molestiae ad natus! Consectetur hic quam numquam magni eveniet
                    aliquam aspernaturem ipsum dolor sit amet consectetur adipisicing elit. Repellendus et magni illum
                    eaque vitae alias
                    esse! Explicabo corporis libero molestiae ad natus! Consectetur hic quam numquam magni eveniet
                    aliquam aspe!</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis quod, in odit et neque laborum
                    exercitationem perspiciatis eius distinctio molestiae veniam porro. Quibusdam nulla repellat alias
                    sapiente suscipit, minus enim.</p>
            </div>

        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Mas sobre nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ad quam necessitatibus, magni delectus ab
                    ut minus eum dolorem nisi hic pariatur quod sed at laborum veritatis omnis exercitationem
                    perferendis officia.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ad quam necessitatibus, magni delectus ab
                    ut minus eum dolorem nisi hic pariatur quod sed at laborum veritatis omnis exercitationem
                    perferendis officia.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ad quam necessitatibus, magni delectus ab
                    ut minus eum dolorem nisi hic pariatur quod sed at laborum veritatis omnis exercitationem
                    perferendis officia.</p>
            </div>
        </div>
    </section>

    <?php
 include '../bienesraices/includes/templates/footer.php'
?>