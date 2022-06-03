<form action="{{ url('/stripe-checkout') }}" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_g6do5S237ekq10r65BnxO6S0"
    data-amount="999"
    data-name="Payment Demo"
    data-description="Payment demo with stripe"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto"
    data-zip-code="true">
  </script>
</form>