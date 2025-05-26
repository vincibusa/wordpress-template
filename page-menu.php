<?php
/*
Template Name: Menu Page
*/
get_header(); ?>

<div class="px-40 flex flex-1 justify-center py-5">
    <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
        <div class="flex flex-col gap-10">
            <header class="flex flex-col items-center gap-6 text-center">
                <h1 class="text-[#1c110d] text-5xl font-bold leading-tight tracking-[-0.025em]">Our Menu</h1>
                <p class="text-[#9b5d4b] text-base font-normal leading-normal max-w-[480px]">
                    Discover a symphony of flavors with our thoughtfully curated menu, featuring the freshest ingredients and culinary artistry.
                </p>
            </header>
            <div class="flex items-center justify-center gap-4">
                <a
                    href="#"
                    class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 bg-[#9b5d4b] text-[#fcf9f8] text-sm font-bold leading-normal tracking-[0.015em]"
                >
                    <span class="truncate">Appetizers</span>
                </a>
                <a
                    href="#"
                    class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 bg-[#f3eae7] text-[#1c110d] text-sm font-bold leading-normal tracking-[0.015em]"
                >
                    <span class="truncate">Main Courses</span>
                </a>
                <a
                    href="#"
                    class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 bg-[#f3eae7] text-[#1c110d] text-sm font-bold leading-normal tracking-[0.015em]"
                >
                    <span class="truncate">Desserts</span>
                </a>
                <a
                    href="#"
                    class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 bg-[#f3eae7] text-[#1c110d] text-sm font-bold leading-normal tracking-[0.015em]"
                >
                    <span class="truncate">Drinks</span>
                </a>
            </div>
            <div class="grid grid-cols-1 gap-6 @[768px]:grid-cols-2">
                <div class="flex flex-col gap-4 rounded-xl border border-solid border-[#f3eae7] p-6">
                    <picture class="aspect-video w-full rounded-lg overflow-hidden">
                        <img
                            src="https://firebasestorage.googleapis.com/v0/b/codeless-dev.appspot.com/o/projects%2FYE0SoLpauRjS3f72h34j%2F40697611734744d0dec11009f58597119d218cff_Rectangle%207.png?alt=media&token=a5e15b58-e5a5-4106-8499-1d748bd02933"
                            alt="Bruschetta al Pomodoro"
                        />
                    </picture>
                    <div class="flex flex-col gap-1">
                        <h3 class="text-[#1c110d] text-lg font-bold leading-tight tracking-[-0.015em]">Bruschetta al Pomodoro</h3>
                        <p class="text-[#9b5d4b] text-sm font-normal leading-normal">Grilled bread rubbed with garlic and topped with fresh tomatoes, basil, and olive oil.</p>
                    </div>
                    <p class="text-[#1c110d] text-base font-bold leading-normal">$12</p>
                </div>
                <div class="flex flex-col gap-4 rounded-xl border border-solid border-[#f3eae7] p-6">
                    <picture class="aspect-video w-full rounded-lg overflow-hidden">
                        <img
                            src="https://firebasestorage.googleapis.com/v0/b/codeless-dev.appspot.com/o/projects%2FYE0SoLpauRjS3f72h34j%2F8ab262439c6cd104c5e30823b697cd455539f51c_Rectangle%207.png?alt=media&token=cb7015f0-9776-491c-8a5e-20d965077222"
                            alt="Calamari Fritti"
                        />
                    </picture>
                    <div class="flex flex-col gap-1">
                        <h3 class="text-[#1c110d] text-lg font-bold leading-tight tracking-[-0.015em]">Calamari Fritti</h3>
                        <p class="text-[#9b5d4b] text-sm font-normal leading-normal">Crispy fried calamari served with a zesty marinara sauce and lemon wedges.</p>
                    </div>
                    <p class="text-[#1c110d] text-base font-bold leading-normal">$15</p>
                </div>
                <div class="flex flex-col gap-4 rounded-xl border border-solid border-[#f3eae7] p-6">
                    <picture class="aspect-video w-full rounded-lg overflow-hidden">
                        <img
                            src="https://firebasestorage.googleapis.com/v0/b/codeless-dev.appspot.com/o/projects%2FYE0SoLpauRjS3f72h34j%2Fb696372211a23b3416657788871b9655aa901c76_Rectangle%207.png?alt=media&token=363d1894-8c62-4e97-94b5-1a22894b7825"
                            alt="Caprese Salad"
                        />
                    </picture>
                    <div class="flex flex-col gap-1">
                        <h3 class="text-[#1c110d] text-lg font-bold leading-tight tracking-[-0.015em]">Caprese Salad</h3>
                        <p class="text-[#9b5d4b] text-sm font-normal leading-normal">Fresh mozzarella, ripe tomatoes, and basil drizzled with balsamic glaze.</p>
                    </div>
                    <p class="text-[#1c110d] text-base font-bold leading-normal">$14</p>
                </div>
                <div class="flex flex-col gap-4 rounded-xl border border-solid border-[#f3eae7] p-6">
                    <picture class="aspect-video w-full rounded-lg overflow-hidden">
                        <img
                            src="https://firebasestorage.googleapis.com/v0/b/codeless-dev.appspot.com/o/projects%2FYE0SoLpauRjS3f72h34j%2F97811eb327f7061d605d33313126416c09b38779_Rectangle%207.png?alt=media&token=942a2037-97df-4abf-901f-0f817f149dd6"
                            alt="Mushroom Arancini"
                        />
                    </picture>
                    <div class="flex flex-col gap-1">
                        <h3 class="text-[#1c110d] text-lg font-bold leading-tight tracking-[-0.015em]">Mushroom Arancini</h3>
                        <p class="text-[#9b5d4b] text-sm font-normal leading-normal">Creamy risotto balls filled with mushrooms and cheese, fried until golden brown.</p>
                    </div>
                    <p class="text-[#1c110d] text-base font-bold leading-normal">$16</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
