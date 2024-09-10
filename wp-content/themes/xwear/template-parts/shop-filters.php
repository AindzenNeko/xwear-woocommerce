<section class="filters__section">
        <form class="filters__form" method="get">
            <div class="filters__accordion">

                <div class="accordion__item">
                    <div class="accordion__header">
                        Categories
                        <svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.64645 0.146447C3.84171 -0.0488155 4.15829 -0.0488155 4.35355 0.146447L7.53553 3.32843C7.7308 3.52369 7.7308 3.84027 7.53553 4.03553C7.34027 4.2308 7.02369 4.2308 6.82843 4.03553L4 1.20711L1.17157 4.03553C0.976311 4.2308 0.659728 4.2308 0.464466 4.03553C0.269204 3.84027 0.269204 3.52369 0.464466 3.32843L3.64645 0.146447ZM3.5 1.5L3.5 0.5L4.5 0.5L4.5 1.5L3.5 1.5Z" fill="#232323"/>
                        </svg>
                    </div>
                    <div class="accordion__content">
                        <div class="filters__checkboxes">
                            <?php
                                $categories = get_terms(array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => false,
                                ));
                                foreach($categories as $category) {
                                    echo '<label for="'.$category->slug.'">
                                            <input type="checkbox" id="'.$category->slug.'" value="'.$category->term_id.'">
                                            <span class="custom-checkbox"></span>
                                            <span>'.$category->name.'</span>
                                          </label>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            
                <div class="accordion__item">
                    <div class="accordion__header">
                        Filter by price
                        <svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.64645 0.146447C3.84171 -0.0488155 4.15829 -0.0488155 4.35355 0.146447L7.53553 3.32843C7.7308 3.52369 7.7308 3.84027 7.53553 4.03553C7.34027 4.2308 7.02369 4.2308 6.82843 4.03553L4 1.20711L1.17157 4.03553C0.976311 4.2308 0.659728 4.2308 0.464466 4.03553C0.269204 3.84027 0.269204 3.52369 0.464466 3.32843L3.64645 0.146447ZM3.5 1.5L3.5 0.5L4.5 0.5L4.5 1.5L3.5 1.5Z" fill="#232323"/>
                        </svg>
                    </div>
                    <div class="accordion__content">
                        <div class="range__wrapper">
                            <div class="range__row">
                                <label for="input0" class="range__label">
                                    <input type="number" class="range__input" id="input0">
                                    <span>$</span>
                                </label>
                                <span>-</span>
                                <label for="input1" class="range__label">
                                    <input type="number" class="range__input" id="input1">
                                    <span>$</span>
                                </label>
                            </div>
                            <div id="filters-range-price"></div> 
                        </div>
                    </div>
                </div>
            
                <div class="accordion__item">
                    <div class="accordion__header">
                        Sizes (EU)
                        <svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.64645 0.146447C3.84171 -0.0488155 4.15829 -0.0488155 4.35355 0.146447L7.53553 3.32843C7.7308 3.52369 7.7308 3.84027 7.53553 4.03553C7.34027 4.2308 7.02369 4.2308 6.82843 4.03553L4 1.20711L1.17157 4.03553C0.976311 4.2308 0.659728 4.2308 0.464466 4.03553C0.269204 3.84027 0.269204 3.52369 0.464466 3.32843L3.64645 0.146447ZM3.5 1.5L3.5 0.5L4.5 0.5L4.5 1.5L3.5 1.5Z" fill="#232323"/>
                        </svg>
                    </div>
                    <div class="accordion__content">
                        <div class="filters__radioboxes">
                            <?php
                                $categories = get_terms(array(
                                    'taxonomy' => wc_attribute_taxonomy_name('size'),
                                    'hide_empty' => false,
                                ));
                                foreach($categories as $category) {
                                    echo '<div class="radioboxes__body">
                                            <input type="checkbox" class="radioboxes__radio" value="'.$category->term_id.'" id="'.$category->slug.'" name="filters-radioboxes">
                                            <label for="'.$category->slug.'" class="radioboxes__label">
                                                <div class="radioboxes__value">'.$category->name.'</div>
                                            </label>
                                          </div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="accordion__item">
                    <div class="accordion__header">
                        Brand
                        <svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.64645 0.146447C3.84171 -0.0488155 4.15829 -0.0488155 4.35355 0.146447L7.53553 3.32843C7.7308 3.52369 7.7308 3.84027 7.53553 4.03553C7.34027 4.2308 7.02369 4.2308 6.82843 4.03553L4 1.20711L1.17157 4.03553C0.976311 4.2308 0.659728 4.2308 0.464466 4.03553C0.269204 3.84027 0.269204 3.52369 0.464466 3.32843L3.64645 0.146447ZM3.5 1.5L3.5 0.5L4.5 0.5L4.5 1.5L3.5 1.5Z" fill="#232323"/>
                        </svg>
                    </div>
                    <div class="accordion__content">
                        <div class="filters__checkboxes">
                            <?php
                                $categories = get_terms(array(
                                    'taxonomy' => wc_attribute_taxonomy_name('brand'),
                                    'hide_empty' => false,
                                ));
                                // echo '<pre style="width:500px; height:500px;">';
                                //     print_r($categories);
                                // echo '</pre>';
                                foreach($categories as $category) {
                                    echo '<label for="'.$category->slug.'">
                                            <input type="checkbox" id="'.$category->slug.'" value="'.$category->term_id.'">
                                            <span class="custom-checkbox"></span>
                                            <span>'.$category->name.'</span>
                                          </label>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                

                <div class="accordion__item">
                    <div class="accordion__header">
                        Model
                        <svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.64645 0.146447C3.84171 -0.0488155 4.15829 -0.0488155 4.35355 0.146447L7.53553 3.32843C7.7308 3.52369 7.7308 3.84027 7.53553 4.03553C7.34027 4.2308 7.02369 4.2308 6.82843 4.03553L4 1.20711L1.17157 4.03553C0.976311 4.2308 0.659728 4.2308 0.464466 4.03553C0.269204 3.84027 0.269204 3.52369 0.464466 3.32843L3.64645 0.146447ZM3.5 1.5L3.5 0.5L4.5 0.5L4.5 1.5L3.5 1.5Z" fill="#232323"/>
                        </svg>
                    </div>
                        <div class="accordion__content">
                            <div class="filters__checkboxes">
                                <?php
                                    $categories = get_terms(array(
                                        'taxonomy' => wc_attribute_taxonomy_name('model'),
                                        'hide_empty' => false,
                                    ));
                                    // echo '<pre style="width:500px; height:500px;">';
                                    //     print_r($categories);
                                    // echo '</pre>';
                                    foreach($categories as $category) {
                                        echo '<label for="'.$category->slug.'">
                                                <input type="checkbox" id="'.$category->slug.'" value="'.$category->term_id.'">
                                                <span class="custom-checkbox"></span>
                                                <span>'.$category->name.'</span>
                                            </label>';
                                    }
                                ?>
                        </div>
                    </div>
                </div>

                <div class="accordion__item">
                    <div class="accordion__header">
                        Color
                        <svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.64645 0.146447C3.84171 -0.0488155 4.15829 -0.0488155 4.35355 0.146447L7.53553 3.32843C7.7308 3.52369 7.7308 3.84027 7.53553 4.03553C7.34027 4.2308 7.02369 4.2308 6.82843 4.03553L4 1.20711L1.17157 4.03553C0.976311 4.2308 0.659728 4.2308 0.464466 4.03553C0.269204 3.84027 0.269204 3.52369 0.464466 3.32843L3.64645 0.146447ZM3.5 1.5L3.5 0.5L4.5 0.5L4.5 1.5L3.5 1.5Z" fill="#232323"/>
                        </svg>
                    </div>
                    <div class="accordion__content">
                        <div class="filters__color">
                            <?php
                                $categories = get_terms(array(
                                    'taxonomy' => wc_attribute_taxonomy_name('color'),
                                    'hide_empty' => false,
                                ));
                                foreach($categories as $category) {
                                    echo '<label class="color__label" for="'.$category->slug.'">
                                            <input class="color__input" type="radio" name="filters-color" value="'.$category->term_id.'" id="'.$category->slug.'">
                                            <div class="color__row">
                                                <div class="color__circle" style="background-color: '.get_term_meta($category->term_id)['cfvsw_color'][0].';"></div>
                                                <div class="color__title">'.$category->name.'</div>
                                            </div>
                                          </label>';
                                }
                            ?>
                        </div>
                    </div>
                </div>

            </div>

            <button type="submit" class="filters__btn filters__btn-submit">
                Apply filters
                <svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.64645 0.146447C3.84171 -0.0488155 4.15829 -0.0488155 4.35355 0.146447L7.53553 3.32843C7.7308 3.52369 7.7308 3.84027 7.53553 4.03553C7.34027 4.2308 7.02369 4.2308 6.82843 4.03553L4 1.20711L1.17157 4.03553C0.976311 4.2308 0.659728 4.2308 0.464466 4.03553C0.269204 3.84027 0.269204 3.52369 0.464466 3.32843L3.64645 0.146447ZM3.5 1.5L3.5 0.5L4.5 0.5L4.5 1.5L3.5 1.5Z" fill="#232323"/>
                </svg>
            </button>
            <button type="reset" class="filters__btn filters__btn-reset">
                Reset all filters
                <svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 7.49954L7.99954 0.5M8 7.49977L1.00046 0.50023" stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </form>
</section>