<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('portal/menu/content/function/f_elibrary');?>
<!-- Section: intro -->
<section id="intro" class="intro">
    <div class="intro-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="wow fadeInDown" data-wow-delay="0.1s">
                        <div class="section-title text-center">
                            <h2 class="h-bold">e-Library</h2>
                            <p class="text-center">Perpustakan Online Rumah Sakit</p>
                        </div>
                    </div>
                    <div class="divider-short"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="home-section paddingtop-80">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <img src="<?=base_url(); ?>asset/portal/img/dummy/img-6.png" width="100%" class="lazyload"
                        alt="Dr.Layanan RSUD LEUWILIANG" />
                </div>
            </div>
            <div class="col-sm-6 col-md-6  box__library">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <div class="box text-center box__animate">
                        <i class="fas fa-book-reader fa-3x circled bg-skin"></i>
                        <h4 class="h-bold">Perpustakaan Online Kami</h4>
                        <p>Temukan Informasi Bermanfaat Tentang Dunia Kesehatan dari kami, Berupa Buku, Artikel, Jurnal,
                            Hingga berbagai undang-undang yang mengatur Tentang Kesehatan </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="home-section nopadding-top bg-gray paddingbot-50">
    <div class="container paddingtop-30">
        <div class="row">
            <div class="col-lg-8">
                <div id="filters-container" class="cbp-l-filters-alignLeft">
                    <div data-filter="*" class="cbp-filter-item-active cbp-filter-item">All (<div
                            class="cbp-filter-counter"></div>)</div>
                    <div data-filter=".cardiologist" class="cbp-filter-item">BUKU (<div class="cbp-filter-counter">
                        </div>)</div>
                    <div data-filter=".psychiatrist" class="cbp-filter-item">ARTIKEL (<div class="cbp-filter-counter">
                        </div>)</div>
                    <div data-filter=".neurologist" class="cbp-filter-item">LEFLET (<div class="cbp-filter-counter">
                        </div>)</div>
                    <div data-filter=".leflet" class="cbp-filter-item">PERMENKES (<div class="cbp-filter-counter"></div>
                        )</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cbp-search">
                    <!-- data-search attribute is used to target the searching with a jQuery selector. For full search set data-search="*" -->
                    <input id="js-search-library" type="text" placeholder="Search by title"
                        data-search=".cbp-l-grid-team-name" class="cbp-search-input">
                    <div class="cbp-search-icon"></div>
                </div>
            </div>
            <div class="col-lg-12 lib-loading">
                <div id="grid-container" class="cbp-l-grid-team">
                    <ul></ul>
                </div>
            </div>
            <div class="col-lg-12 text-center paddingtop-40">
                <div id="pagination" class="pagination justify-content-center"></div>
            </div>
        </div>
    </div>
</section>