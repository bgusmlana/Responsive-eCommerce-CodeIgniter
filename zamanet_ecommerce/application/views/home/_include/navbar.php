        <!-- mobile site__header -->
        <header class="site__header d-lg-none">
            <!-- data-sticky-mode - one of [pullToShow, alwaysOnTop] -->
            <div class="mobile-header mobile-header--sticky" data-sticky-mode="pullToShow">
                <div class="mobile-header__panel">
                    <div class="container">
                        <div class="mobile-header__body">
                            <button class="mobile-header__menu-button">
                                <svg width="18px" height="14px">
                                    <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#menu-18x14"></use>
                                </svg>
                            </button>

                            <?php
                            $logo = $this->model_app->view_ordering_limit('tb_web_logo', 'id_logo', 'DESC', 0, 1);
                            foreach ($logo->result_array() as $row) {
                                echo "<a href='" . base_url() . "' class='mobile-header__logo'><img height='40px' src='" . base_url() . "assets/images/logo/$row[gambar]'/></a>";
                            }
                            ?>


                            <div class="search search--location--mobile-header mobile-header__search">
                                <div class="search__body">
                                    <form class="search__form" action="<?= base_url('cari') ?>" method="POST">
                                        <input class="search__input" name="cari" placeholder="Saya ingin mencari.." aria-label="Site search" type="text" autocomplete="off">
                                        <button class="search__button search__button--type--submit" type="submit" name="submit">
                                            <svg width="20px" height="20px">
                                                <use xlink:href="images/sprite.svg#search-20"></use>
                                            </svg>
                                        </button>
                                        <button class="search__button search__button--type--close" type="button">
                                            <svg width="20px" height="20px">
                                                <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#cross-20"></use>
                                            </svg>
                                        </button>
                                        <div class="search__border"></div>
                                    </form>
                                </div>
                            </div>

                            <div class="mobile-header__indicators">
                                <div class="indicator indicator--mobile-search indicator--mobile d-sm-none">
                                    <button class="indicator__button">
                                        <span class="indicator__area">
                                            <svg width="20px" height="20px">
                                                <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#search-20"></use>
                                            </svg>
                                        </span>
                                    </button>
                                </div>

                                <div class="indicator indicator--mobile">
                                    <a href="#" class="indicator__button" data-open="offcanvas-cart">
                                        <span class="indicator__area"><svg width="20px" height="20px">
                                                <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#cart-20"></use>
                                            </svg>

                                            <?php
                                            $this->db->where('session', $this->session->idp);
                                            $num_rows = $this->db->count_all_results('tb_toko_penjualantemp');
                                            $isi_keranjang = $num_rows;
                                            ?>

                                            <?php if (empty($isi_keranjang)) {
                                                echo '';
                                            } else { ?>
                                                <span class="indicator__value"><?= $isi_keranjang; ?></span>
                                            <?php } ?>
                                        </span>
                                    </a>
                                </div>

                                <div class="indicator indicator--mobile">

                                    <a href="<?= base_url('members/dashboard') ?>" class="indicator__button">
                                        <span class="indicator__area">
                                            <svg width="20px" height="20px">
                                                <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#person-20"></use>
                                            </svg>
                                        </span>
                                    </a>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </header>

        <header class="site__header d-lg-block d-none">
            <div class="site-header">
                <!-- .topbar -->
                <?php
                $menu = $this->model_menu->menu_topbar();
                if ($menu->num_rows() > 0) { ?>

                    <div class="site-header__topbar topbar">
                        <div class="topbar__container container">
                            <div class="topbar__row">
                                <?php
                                foreach ($menu->result_array() as $rowx) {
                                ?>
                                    <div class="topbar__item topbar__item--link"><a class="topbar-link" href="<?= base_url() . $rowx['link']; ?>"><?= $rowx['nama_menu']; ?></a></div>
                                <?php } ?>
                                <div class="topbar__spring"></div>
                            </div>
                        </div>
                    </div>

                <?php } ?>
                <!-- .topbar / end -->
                <div class="site-header__nav-panel">
                    <!-- data-sticky-mode - one of [pullToShow, alwaysOnTop] -->
                    <div class="nav-panel nav-panel--sticky" data-sticky-mode="pullToShow">
                        <div class="nav-panel__container container">
                            <div class="nav-panel__row">

                                <div class="nav-panel__logo mr-2">
                                    <a href="<?= base_url() ?>">
                                        <?php
                                        $logo = $this->model_app->view_ordering_limit('tb_web_logo', 'id_logo', 'DESC', 0, 1);
                                        foreach ($logo->result_array() as $row) {
                                            echo "<a href='" . base_url() . "'><img height='40px' src='" . base_url() . "assets/images/logo/$row[gambar]'/></a>";
                                        }
                                        ?>
                                    </a>
                                </div><!-- .nav-links -->

                                <div class="nav-panel__nav-links nav-links">
                                    <ul class="nav-links__list">

                                        <?php
                                        $menu = $this->model_menu->menu_main();
                                        foreach ($menu->result_array() as $row) {
                                            $dropdown = $this->model_menu->dropdown_menu($row['id_menu'])->num_rows();
                                            if ($dropdown == 0) {
                                        ?>
                                                <li class="nav-links__item">
                                                    <a class="nav-links__item-link" href="<?= base_url() . $row['link']; ?>">
                                                        <div class="nav-links__item-body"><?= $row['nama_menu']; ?></div>
                                                    </a>
                                                </li>

                                            <?php } else { ?>

                                                <li class="nav-links__item nav-links__item--has-submenu">
                                                    <a class="nav-links__item-link" href="#">
                                                        <div class="nav-links__item-body"><?= $row['nama_menu']; ?>
                                                            <svg class="nav-links__item-arrow" width="9px" height="6px">
                                                                <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#arrow-rounded-down-9x6">
                                                                </use>
                                                            </svg>
                                                        </div>
                                                    </a>
                                                    <div class="nav-links__submenu nav-links__submenu--type--menu">
                                                        <!-- .menu -->
                                                        <div class="menu menu--layout--classic">
                                                            <div class="menu__submenus-container"></div>
                                                            <ul class="menu__list">
                                                                <?php
                                                                $dropmenu = $this->model_menu->dropdown_menu($row['id_menu']);
                                                                foreach ($dropmenu->result_array() as $row) { ?>

                                                                    <li class="menu__item">
                                                                        <div class="menu__item-submenu-offset"></div>
                                                                        <a class="menu__item-link" href="<?= base_url() . $row['link']; ?>">
                                                                            <?= $row['nama_menu']; ?>
                                                                        </a>
                                                                    </li>

                                                                <?php } ?>

                                                            </ul>
                                                        </div><!-- .menu / end -->
                                                    </div>
                                                </li>

                                        <?php }
                                        } ?>

                                    </ul>
                                </div><!-- .nav-links / end -->



                                <div class="nav-panel__indicators">

                                    <div class="indicator indicator--trigger--click">
                                        <button type="button" class="indicator__button">
                                            <span class="indicator__area">
                                                <svg class="indicator__icon" width="20px" height="20px">
                                                    <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#search-20"></use>
                                                </svg>
                                                <svg class="indicator__icon indicator__icon--open" width="20px" height="20px">
                                                    <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#cross-20"></use>
                                                </svg>
                                            </span>
                                        </button>
                                        <div class="indicator__dropdown">
                                            <div class="search search--location--indicator">
                                                <div class="search__body">
                                                    <form class="search__form" action="<?= base_url('cari') ?>" method="POST">
                                                        <input class="search__input" name="cari" placeholder="Sayang ingin mencari.." aria-label="Site search" type="text" autocomplete="off">
                                                        <button class="search__button search__button--type--submit" type="submit">
                                                            <svg width="20px" height="20px">
                                                                <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#search-20"></use>
                                                            </svg>
                                                        </button>
                                                        <div class="search__border"></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="indicator">
                                        <a href="#" class="indicator__button" data-open="offcanvas-cart">
                                            <span class="indicator__area">
                                                <svg width="20px" height="20px">
                                                    <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#cart-20"></use>
                                                </svg>

                                                <?php if (empty($isi_keranjang)) {
                                                    echo '';
                                                } else {
                                                    echo "<span class='indicator__value'>";
                                                    echo $isi_keranjang;
                                                    echo "</span>";
                                                }; ?>

                                            </span>
                                        </a>

                                    </div>

                                    <div class="indicator indicator--trigger--click">

                                        <a href="account-login.html" class="indicator__button">
                                            <span class="indicator__area">
                                                <svg width="20px" height="20px">
                                                    <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#person-20"></use>
                                                </svg>
                                            </span>
                                        </a>

                                        <div class="indicator__dropdown">
                                            <div class="account-menu">

                                                <?php
                                                if (empty($this->session->id_pengguna)) { ?>

                                                    <form class="account-menu__form" action="<?= base_url('login') ?>" method="POST">
                                                        <div class="account-menu__form-title">Masuk ke akun Anda</div>
                                                        <div class="form-group">
                                                            <label for="header-signin-email" class="sr-only">Email / Username</label>
                                                            <input name="user_email" id="header-signin-email" type="text" class="form-control form-control-sm" placeholder="Email / Username">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="header-signin-password" class="sr-only">Password</label>
                                                            <div class="account-menu__form-forgot">
                                                                <input name="password" id="header-signin-password" type="password" class="form-control form-control-sm" placeholder="Password">
                                                                <a href="<?= base_url('auth/lupa_password') ?>" class="account-menu__form-forgot-link">Lupa?</a>
                                                            </div>
                                                        </div>
                                                        <div class="form-group account-menu__form-button">
                                                            <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
                                                        </div>
                                                        <div class="account-menu__form-link">
                                                            <a href="<?= base_url('register') ?>">Buat akun baru</a>
                                                        </div>
                                                    </form>
                                                    <div class="account-menu__divider"></div>

                                                <?php } ?>

                                                <?php
                                                if (!empty($this->session->id_pengguna)) { ?>

                                                    <?php
                                                    $id = $this->session->id_pengguna;
                                                    $this->db->where("id_pengguna='$id'");
                                                    $peng = $this->db->get('tb_pengguna')->row_array();
                                                    if (empty($peng['nama_lengkap'])) {
                                                        $nama = $peng['username'];
                                                    } else {
                                                        $nama = $peng['nama_lengkap'];
                                                    }

                                                    if (empty($peng['foto'])) {
                                                        $foto = 'default.jpg';
                                                    } else {
                                                        $foto = $peng['foto'];
                                                    }
                                                    ?>

                                                    <a href="<?= base_url('members/dashboard') ?>" class="account-menu__user">
                                                        <div class="account-menu__user-avatar"><img src="<?= base_url('assets/images/user/' . $foto) ?>" alt=""></div>
                                                        <div class="account-menu__user-info">
                                                            <div class="account-menu__user-name"><?= $nama ?></div>
                                                            <div class="account-menu__user-email"><?= $peng['email'] ?></div>
                                                        </div>
                                                    </a>
                                                    <div class="account-menu__divider"></div>
                                                    <ul class="account-menu__links">
                                                        <li><a href="<?= base_url('members/edit_profile') ?>">Profil</a></li>
                                                        <li><a href="<?= base_url('members/riwayat_belanja') ?>">Riwayat Transaksi</a></li>
                                                        <li><a href="<?= base_url('members/edit_alamat') ?>">Alamat</a></li>
                                                        <li><a href="<?= base_url('members/password') ?>">Password</a></li>
                                                    </ul>
                                                    <div class="account-menu__divider"></div>
                                                    <ul class="account-menu__links">
                                                        <li><a href="javascript:void(0)" onclick="logout()">Keluar</a></li>
                                                    </ul>

                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>

                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>