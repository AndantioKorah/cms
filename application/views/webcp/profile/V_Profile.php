<style>
  .title-custom::after {
    content: "";
    width: 150px;
    height: 1px;
    display: inline-block;
    background: var(--primary);
    margin: 12px 10px;
  }

  .tupoksi-content h5{
    line-height: 30px;
  }
</style>
<main id="main" class="mt-3">
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2><?=$this->lang->line('profile')?></h2>
        <ol>
          <li><a href="<?=base_url('home')?>"><?=$this->lang->line('home')?></a></li>
          <li><a><?=$this->lang->line('profile')?></a></li>
        </ol>
      </div>
    </div>
  </section>

  <section id="about" class="about">
    <div class="container">

      <div class="row content">
        <div class="col-lg-6">
          <!-- <h1>Visi</h1> -->
          <div class="section-title">
            <!-- <h2>Team</h2> -->
            <p>Visi</p>
          </div>
          <h2><?=$visi?></h2>
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0">
          <div class="section-title">
            <!-- <h2>Team</h2> -->
            <p>Misi</p>
          </div>
          <table>
            <?php $i = 1; foreach($misi as $m) { ?>
              <tr valign="top">
                <td><h4 style="line-height: 40px;"><?=$i++;?>.</h4></td>
                <td><h4 style="line-height: 40px;"><?=$m;?></h4></td>
              </tr>
            <?php } ?>
          </table>
          
          <!-- <ul>
            <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequa</li>
            <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit</li>
            <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in</li>
          </ul>
          <p class="fst-italic">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua.
          </p> -->
        </div>
      </div>

    </div>
  </section>

  <section id="motto" class="team section-bg">
    <div class="container">
      <div class="section-title">
        <!-- <h2>Team</h2> -->
        <p>MOTTO</p>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <h2><?=$motto?></h2>
        </div>
      </div>
    </div>
  </section>

  <section id="tupoksi" class="team">
    <div class="container">
      <div class="section-title">
        <!-- <h2>Team</h2> -->
        <p>TUGAS POKOK & FUNGSI</p>
      </div>
      <div class="row content">
        <div class="col-lg-12 tupoksi-content">
          <?php foreach($tupoksi_pr as $pr){ ?>
            <h5 style="line-height: 35px;"><?=$pr?></h5>
          <?php } ?>
          <table>
            <?php $i = 1; foreach($tupoksi_poin as $p) { ?>
              <tr valign="top">
                <td style="width: 2%;"><h5><?=$i++;?>.</h5></td>
                <td><h5 style="line-height: 35px;"><?=$p;?></h5></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </section>

</main>