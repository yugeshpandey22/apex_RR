<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="<?= BASE_URL ?>assets/js/main.js"></script>

<!-- intl-tel-input JS for country code -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
  $(document).ready(function() {
      var phoneInputs = document.querySelectorAll('input[type="tel"]');
      phoneInputs.forEach(function(input) {
          window.intlTelInput(input, {
              initialCountry: "in",
              separateDialCode: true,
              utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
          });
      });
  });
</script>
