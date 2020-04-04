<!-- Sidebar  -->
<nav id="sidebar" class="sidebar">
      <div id="dismiss" class="dismiss">
        <i class="fas fa-arrow-right"></i>
      </div>

      <div class="sidebar-header">
        <h3>Your Cart :</h3>
      </div>

      <div class="cart-items">
       
      </div>


      <div class="footer">
        <div class="counts">
          <p class="subtotal">Subtotal: $<span>00.00</span></p>
          <p class="tax">Taxes (5%): $<span>00.00</span></p>
          <p class="shipping">Shipping: $<span>05.00</span></p>
          <p class="total">Total: $<span>00.00</span></p>
        </div>

      </div>
      <ul class="list-unstyled checkout">
      <?php if (Helper::isGuest()) :?>
            <li>
            To make your order please <a href="/login" class="check-out">Sign In</a>
            </li>
        <?php else :?>
            <li>
                <a href="#" class="check-out checkout__now">Checkout</a>
            </li>
        <?php endif;?>
        <li>
          <a href="#" class="clear-cart">Clear Cart</a>
        </li>
      </ul>
    </nav>