<div class="review">
                        <!-- Name, avatar, rate printing -->
                        <div class="review-title">
                            <div class="review-prof">
                                <div class="profileLink" style="margin-right:5px">
                                    <img src="http://localhost/project_two/images/user/<?= $reviews[$i]['avatar_url'] ?>">
                                </div>
                                <h1><?= $reviews[$i]['user_name'] ?></h1>   
                            </div>
                            <!-- Coloring the rate -->
                            <?php
                                if ($reviews[$i]['rating'] <= 10 && $reviews[$i]['rating'] > 6) {
                                    $rating_color = 'green';
                                } elseif ($reviews[$i]['rating'] <= 6 && $reviews[$i]['rating'] > 4) {
                                    $rating_color = 'yellow';
                                } else {
                                    $rating_color = 'red';
                                }
                            ?>
                            <div>
                                <div class="rating <?= $rating_color ?>"><h1><?= $reviews[$i]['rating'] ?></h1></div>
                                <?php if ($reviews[$i]['user_id'] == $user_id): ?>
                                    <!-- modal of edit and delete -->
                                    <button class='three-dots-button' id="openModalBtn">
                                            <div class="dot"></div>
                                            <div class="dot"></div>
                                            <div class="dot"></div>
                                    </button>
                                    <div id="modal" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal()">&times;</span>
                                            <ul>
                                                <li><a href="http://localhost/project_two/review/EditReviewFrom.php?review_id=<?= $reviews[$i]['review_id'] ?>&game_id=<?=$game_id?>">Edit</a></li>
                                                <li><button href="" onclick="confirmDelete(<?= $reviews[$i]['review_id']?>,  <?=$game_id?>, <?=$user_id?>)">Delete</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php $reviews[$i]['status'] = 'review has'; $index = $i; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <p><?= $reviews[$i]['comment'] ?></p>
                        <p class="date">Date: <?= $reviews[$i]['review_date'] ?></p>
                    </div>