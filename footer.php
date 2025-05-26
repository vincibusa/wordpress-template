<footer class="flex justify-center">
  <div class="flex max-w-[960px] flex-1 flex-col">
    <footer class="flex flex-col gap-6 px-5 py-10 text-center @container">
      <div class="flex flex-wrap items-center justify-center gap-6 @[480px]:flex-row @[480px]:justify-around">
        <a class="text-[#9b5d4b] text-base font-normal leading-normal min-w-40" href="<?php echo home_url('/#about-us'); ?>">About</a>
        <a class="text-[#9b5d4b] text-base font-normal leading-normal min-w-40" href="<?php echo site_url('/menu/'); ?>">Menu</a>
        <a class="text-[#9b5d4b] text-base font-normal leading-normal min-w-40" href="#">Reservations</a>
        <a class="text-[#9b5d4b] text-base font-normal leading-normal min-w-40" href="<?php echo site_url('/contact/'); ?>">Contact</a>
        <a class="text-[#9b5d4b] text-base font-normal leading-normal min-w-40" href="<?php echo site_url('/careers/'); ?>">Careers</a>
      </div>
      <div class="flex flex-wrap justify-center gap-4">
        <!-- Social media icons will be added later -->
      </div>
      <p class="text-[#9b5d4b] text-base font-normal leading-normal">&copy; <?php echo date('Y'); ?> The Gilded Spoon. All rights reserved.</p>
    </footer>
  </div>
</footer>
    </div> <!-- Closing div for layout-container -->
</div> <!-- Closing div for relative flex size-full -->

<!-- Booking Modal -->
<div id="booking-modal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 p-4" role="dialog" aria-modal="true" aria-labelledby="modal-title">
    <div class="bg-[#fcf9f8] p-6 sm:p-8 rounded-xl shadow-2xl w-full max-w-lg transform transition-all">
        <div class="flex justify-between items-center mb-4">
            <h2 id="modal-title" class="text-2xl font-bold text-[#1c110d]">Prenota un Tavolo</h2>
            <button id="close-booking-modal" class="text-[#1c110d] hover:text-[#f15627]" aria-label="Close booking modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div id="modal-content">
            <?php if (function_exists('gildedspoon_display_booking_feedback')) { gildedspoon_display_booking_feedback(); } ?>
            <form id="booking-form" method="POST" action="">
                <?php wp_nonce_field('make_booking_nonce', 'booking_nonce_field'); ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="booking_nome" class="block text-sm font-medium text-[#3a2e29] mb-1">Nome</label>
                        <input type="text" name="booking_nome" id="booking_nome" class="mt-1 block w-full px-3 py-2 bg-white border border-[#e8d5cf] rounded-md shadow-sm focus:outline-none focus:ring-[#f15627] focus:border-[#f15627] sm:text-sm text-[#1c110d]" required>
                    </div>
                    <div>
                        <label for="booking_cognome" class="block text-sm font-medium text-[#3a2e29] mb-1">Cognome</label>
                        <input type="text" name="booking_cognome" id="booking_cognome" class="mt-1 block w-full px-3 py-2 bg-white border border-[#e8d5cf] rounded-md shadow-sm focus:outline-none focus:ring-[#f15627] focus:border-[#f15627] sm:text-sm text-[#1c110d]" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="booking_email" class="block text-sm font-medium text-[#3a2e29] mb-1">Email</label>
                    <input type="email" name="booking_email" id="booking_email" class="mt-1 block w-full px-3 py-2 bg-white border border-[#e8d5cf] rounded-md shadow-sm focus:outline-none focus:ring-[#f15627] focus:border-[#f15627] sm:text-sm text-[#1c110d]" required>
                </div>
                <div class="mb-4">
                    <label for="booking_telefono" class="block text-sm font-medium text-[#3a2e29] mb-1">Numero di telefono</label>
                    <input type="tel" name="booking_telefono" id="booking_telefono" class="mt-1 block w-full px-3 py-2 bg-white border border-[#e8d5cf] rounded-md shadow-sm focus:outline-none focus:ring-[#f15627] focus:border-[#f15627] sm:text-sm text-[#1c110d]" required>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="booking_data" class="block text-sm font-medium text-[#3a2e29] mb-1">Data</label>
                        <input type="date" name="booking_data" id="booking_data" class="mt-1 block w-full px-3 py-2 bg-white border border-[#e8d5cf] rounded-md shadow-sm focus:outline-none focus:ring-[#f15627] focus:border-[#f15627] sm:text-sm text-[#1c110d]" required>
                    </div>
                    <div>
                        <label for="booking_orario" class="block text-sm font-medium text-[#3a2e29] mb-1">Orario</label>
                        <input type="time" name="booking_orario" id="booking_orario" class="mt-1 block w-full px-3 py-2 bg-white border border-[#e8d5cf] rounded-md shadow-sm focus:outline-none focus:ring-[#f15627] focus:border-[#f15627] sm:text-sm text-[#1c110d]" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="booking_note" class="block text-sm font-medium text-[#3a2e29] mb-1">Note (Opzionale)</label>
                    <textarea name="booking_note" id="booking_note" rows="3" class="mt-1 block w-full px-3 py-2 bg-white border border-[#e8d5cf] rounded-md shadow-sm focus:outline-none focus:ring-[#f15627] focus:border-[#f15627] sm:text-sm text-[#1c110d]"></textarea>
                </div>
                <div>
                    <button type="submit" name="submit_booking" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#f15627] hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#f15627]">
                        Invia Richiesta
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
