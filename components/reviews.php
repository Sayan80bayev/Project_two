
                    <div class="review">
                        <!-- Name, avatar, rate printing -->
                        <div class="review-title">
                            <div class="review-prof">
                                <div class="profileLink" style="margin-right:5px">
                                    <img src="http://localhost/project_two/images/user/<?= $review['avatar_url'] ?>">
                                </div>
                                <h1><?= $review['user_name'] ?></h1>   
                            </div>
                            <!-- Coloring the rate -->
                            <?php
                                if ($review['rating'] <= 10 && $review['rating'] > 6) {
                                    $rating_color = 'green';
                                } elseif ($review['rating'] <= 6 && $review['rating'] > 4) {
                                    $rating_color = 'yellow';
                                } else {
                                    $rating_color = 'red';
                                }
                            ?>
                            <div>
                                <div class="rating <?= $rating_color ?>"><h1><?= $review['rating'] ?></h1></div>
                                <?php if ($review['user_id'] == $user_id): ?>
                                    <!-- Modal of edit and delete -->
                                    <button class='three-dots-button openModalBtn'>
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                    </button>
                                    <div class="modal">
                                        <div class="modal-content">
                                            <!-- Close button with onclick attribute -->
                                            <span class="close" onclick="closeModal(event)">&times;</span>
                                            <!-- Edit and delete options -->
                                            <ul>
                                                <li><a href="http://localhost/project_two/review/EditReviewFrom.php?review_id=<?=$review['review_id'] ?>&game_id=<?=$review['game_id']?>">Edit</a></li>
                                                <li><button onclick="confirmDelete(<?= $review['review_id'] ?>,<?=$user_id?> , <?=$review['game_id'] ?>)"> Delete</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php $reviews[$i]['status'] = 'review has'; $index = $i; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <p><?= $review['comment'] ?></p>
                        <p class="date">Date: <?= $review['review_date'] ?></p>
                    </div>