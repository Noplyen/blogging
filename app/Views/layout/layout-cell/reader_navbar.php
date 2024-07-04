<header id="nav-menu" aria-label="navigation bar">
    <div class="container-nav">
        <div class="nav-start">
            <a class="logo" href="">
                <img
                        src="<?= base_url('/images/resource/logo/company-logo.png')?>"
                        width="100"
                        height="45"
                        alt="writelyblog Logo"
                />
            </a>
            <nav class="menu">
                <ul class="menu-bar">
                    <li><a class="nav-link" href="<?=base_url()?>">Home</a></li>
                    <li>
                        <button
                                class="nav-link dropdown-btn"
                                data-dropdown="dropdown2"
                                aria-haspopup="true"
                                aria-expanded="false"
                                aria-label="discover"
                        >
                            Categories
                            <i class="bx bx-chevron-down" aria-hidden="true"></i>
                        </button>
                        <div id="dropdown2" class="dropdown">
                            <ul role="menu">
                                <li>
                                    <span class="dropdown-link-title">Browse Categories</span>
                                </li>

                                <?= view_cell('\App\Libraries\ViewCellContent::navbarArticleItem') ?>


                            </ul>
                        </div>
                    </li>
                    <li><a class="nav-link" href="<?=base_url('profile')?>">Profile</a></li>
                </ul>
            </nav>
        </div>

        <button
                id="hamburger"
                aria-label="hamburger"
                aria-haspopup="true"
                aria-expanded="false"
        >
            <i class="bx bx-menu" aria-hidden="true"></i>
        </button>
    </div>
</header>