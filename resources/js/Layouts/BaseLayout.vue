<template>
    <body>
        <div class="d-flex flex-column justify-content-between min-vh-100">
            <header>
                <nav class="navbar navbar-expand-md bg-body-tertiary">
                    <div class="container">
                        <a :href="route('main')" class="navbar-brand">Leads</a>

                        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbar-collapse">
                            <ul v-show="!$page.props.user" class="navbar-nav ms-auto mb-2 mb-md-0">
                                <li class="nav-item">
                                    <a  href="" class="nav-link" aria-current="page">Авторизация</a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link" aria-current="page">Регистрация</a>
                                </li>
                            </ul>
                            <ul v-show="$page.props.user" class="navbar-nav ms-auto mb-2 mb-md-0">
                                <li class="nav-item">
                                    <a href="" class="nav-link" aria-current="page">Лиды</a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link" aria-current="page">Выход</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>

            <main class="flex-grow-1 py-3">
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-6 offset-md-3">
                                <slot />
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <footer class="py-3 border-top text-center">
                © Leads 2024
            </footer>
        </div>
    </body>
</template>
