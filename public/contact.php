<!-- Configuration-->
<?php require_once("../resources/config.php"); ?>
<!-- Header-->
<?php include(TEMPLATE_FRONT .  "/header.php");?>
         <!-- Contact Section -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contact Us <br/> "Enfin ça ne marche pas, mais essayes toujours ;)"</h2>
                    <h3 class="section-subheading"></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" method="post">
                        <?php  send_message(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Votre nom</label>
                                    <input type="text" name="name" class="form-control" placeholder="Votre Nom *" id="name" required data-validation-required-message="Veuillez saisir votre nom.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <label for="email">Votre email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Votre Email *" id="email" required data-validation-required-message="Veuillez saisir votre email.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <label for="subject">Votre sujet</label>
                                    <input type="text" name="subject" class="form-control" placeholder="Sujet *" id="subject" required data-validation-required-message="Veuillez saisir votre sujet.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="message">Votre message</label>
                                    <textarea name="message" class="form-control" placeholder="Votre Message *" id="message" required data-validation-required-message="Veuillez saisir votre message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button name="submit" type="submit" class="btn btn-xl">Envoyer Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<!-- /.container -->
<?php include(TEMPLATE_FRONT .  "/footer.php");?>