<style>
</style>
<main id="main">
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2><?=$this->lang->line('contact')?></h2>
        <ol>
          <li><a href="<?=base_url('')?>"><?=$this->lang->line('home')?></a></li>
          <li><a><?=$this->lang->line('contact')?></a></li>
        </ol>
      </div>
    </div>
  </section>

  <section id="contact" class="contact">
    <div class="container">
      <form method="post" role="form" class="php-email-form">
        <div class="row">
          <div class="col-md-12">
            <h4>Tulis Pesan Anda</h4>
          </div>
          <div class="col-md-6 form-group">
            <input type="text" name="name" class="form-control" id="name" autocomplete="off" placeholder="Nama Anda">
          </div>
          <div class="col-md-6 form-group mt-3 mt-md-0">
            <input type="email" class="form-control" name="email" id="email" autocomplete="off" placeholder="Email Anda">
          </div>
        </div>
        <div class="form-group mt-3">
          <input type="text" class="form-control" name="subject" id="subject" autocomplete="off" placeholder="Subject" required>
        </div>
        <div class="form-group mt-3">
          <textarea class="form-control" name="message" rows="5" autocomplete="off" placeholder="Pesan Anda" required></textarea>
        </div>
        <!-- <div class="my-3">
          <div class="loading">Loading</div>
          <div class="error-message"></div>
          <div class="sent-message">Your message has been sent. Thank you!</div>
        </div> -->
        <div class="text-center"><button type="submit">Kirim Pesan</button></div>
      </form>
    </div>
  </section>

</main>

<script>
</script>