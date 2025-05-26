<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="relative flex size-full min-h-screen flex-col bg-[#fcf9f8] group/design-root overflow-x-hidden" style='font-family: "Plus Jakarta Sans", "Noto Sans", sans-serif;'>
    <div class="layout-container flex h-full grow flex-col">
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f3eae7] px-10 py-3">
  <a href="<?php echo home_url(); ?>" class="flex items-center gap-4 text-[#1c110d]">
    <div class="size-4">
      <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
          fill-rule="evenodd"
          clip-rule="evenodd"
          d="M39.475 21.6262C40.358 21.4363 40.6863 21.5589 40.7581 21.5934C40.7876 21.655 40.8547 21.857 40.8082 22.3336C40.7408 23.0255 40.4502 24.0046 39.8572 25.2301C38.6799 27.6631 36.5085 30.6631 33.5858 33.5858C30.6631 36.5085 27.6632 38.6799 25.2301 39.8572C24.0046 40.4502 23.0255 40.7407 22.3336 40.8082C21.8571 40.8547 21.6551 40.7875 21.5934 40.7581C21.5589 40.6863 21.4363 40.358 21.6262 39.475C21.8562 38.4054 22.4689 36.9657 23.5038 35.2817C24.7575 33.2417 26.5497 30.9744 28.7621 28.762C30.9744 26.5497 33.2417 24.7574 35.2817 23.5037C36.9657 22.4689 38.4054 21.8562 39.475 21.6262ZM4.41189 29.2403L18.7597 43.5881C19.8813 44.7097 21.4027 44.9179 22.7217 44.7893C24.0585 44.659 25.5148 44.1631 26.9723 43.4579C29.9052 42.0387 33.2618 39.5667 36.4142 36.4142C39.5667 33.2618 42.0387 29.9052 43.4579 26.9723C44.1631 25.5148 44.659 24.0585 44.7893 22.7217C44.9179 21.4027 44.7097 19.8813 43.5881 18.7597L29.2403 4.41187C27.8527 3.02428 25.8765 3.02573 24.2861 3.36776C22.6081 3.72863 20.7334 4.58419 18.8396 5.74801C16.4978 7.18716 13.9881 9.18353 11.5858 11.5858C9.18354 13.988 7.18717 16.4978 5.74802 18.8396C4.58421 20.7334 3.72865 22.6081 3.36778 24.2861C3.02574 25.8765 3.02429 27.8527 4.41189 29.2403Z"
          fill="currentColor"
        ></path>
      </svg>
    </div>
    <h2 class="text-[#1c110d] text-lg font-bold leading-tight tracking-[-0.015em]">The Gilded Spoon</h2>
  </a>
  <div class="flex flex-1 justify-end gap-8">
    <div class="flex items-center gap-9">
      <a class="text-[#1c110d] text-sm font-medium leading-normal" href="<?php echo site_url('/menu/'); ?>">Menu</a>
      <a class="text-[#1c110d] text-sm font-medium leading-normal" href="#">Reservations</a>
      <a class="text-[#1c110d] text-sm font-medium leading-normal" href="<?php echo site_url('/private-dining/'); ?>">Private Dining</a>
      <a class="text-[#1c110d] text-sm font-medium leading-normal" href="<?php echo site_url('/gift-cards/'); ?>">Gift Cards</a>
    </div>
    <button
      id="open-booking-modal-header"
      class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 bg-[#f3eae7] text-[#1c110d] text-sm font-bold leading-normal tracking-[0.015em]"
    >
      <span class="truncate">Prenota Ora</span>
    </button>
  </div>
</header>
