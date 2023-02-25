  <div id="comments" class="post-block mt-5 post-comments">
      <h4 class="mb-3">Comments (3)</h4>

      <ul class="comments">
          <li>
              <div class="comment">
                  <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                      <img class="avatar" alt="" src="img/avatars/avatar-2.jpg">
                  </div>
                  <div class="comment-block">
                      <div class="comment-arrow"></div>
                      <span class="comment-by">
                          <strong>John Doe</strong>
                          <span class="float-right">
                              <span> <a href="#"><i class="fas fa-reply"></i> Reply</a></span>
                          </span>
                      </span>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra
                          euismod odio, gravida pellentesque urna varius vitae, gravida
                          pellentesque urna varius vitae. Lorem ipsum dolor sit amet,
                          consectetur adipiscing elit. Nam viverra euismod odio, gravida
                          pellentesque urna varius vitae. Sed dui lorem, adipiscing in
                          adipiscing et, interdum nec metus. Mauris ultricies, justo eu
                          convallis placerat, felis enim ornare nisi, vitae mattis nulla ante
                          id dui.</p>
                      <span class="date float-right">January 12, 2020 at 1:38 pm</span>
                  </div>
              </div>

              <ul class="comments reply">
                  <li>
                      <div class="comment">
                          <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                              <img class="avatar" alt="" src="img/avatars/avatar-3.jpg">
                          </div>
                          <div class="comment-block">
                              <div class="comment-arrow"></div>
                              <span class="comment-by">
                                  <strong>John Doe</strong>
                                  <span class="float-right">
                                      <span> <a href="#"><i class="fas fa-reply"></i>
                                              Reply</a></span>
                                  </span>
                              </span>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam
                                  viverra euismod odio, gravida pellentesque urna varius
                                  vitae, gravida pellentesque urna varius vitae.</p>
                              <span class="date float-right">January 12, 2020 at 1:38
                                  pm</span>
                          </div>
                      </div>
                  </li>
                  <li>
                      <div class="comment">
                          <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                              <img class="avatar" alt="" src="img/avatars/avatar-4.jpg">
                          </div>
                          <div class="comment-block">
                              <div class="comment-arrow"></div>
                              <span class="comment-by">
                                  <strong>John Doe</strong>
                                  <span class="float-right">
                                      <span> <a href="#"><i class="fas fa-reply"></i>
                                              Reply</a></span>
                                  </span>
                              </span>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam
                                  viverra euismod odio, gravida pellentesque urna varius
                                  vitae, gravida pellentesque urna varius vitae.</p>
                              <span class="date float-right">January 12, 2020 at 1:38
                                  pm</span>
                          </div>
                      </div>
                  </li>
              </ul>
          </li>
          <li>
              <div class="comment">
                  <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                      <img class="avatar" alt="" src="img/avatars/avatar.jpg">
                  </div>
                  <div class="comment-block">
                      <div class="comment-arrow"></div>
                      <span class="comment-by">
                          <strong>John Doe</strong>
                          <span class="float-right">
                              <span> <a href="#"><i class="fas fa-reply"></i> Reply</a></span>
                          </span>
                      </span>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                      <span class="date float-right">January 12, 2020 at 1:38 pm</span>
                  </div>
              </div>
          </li>
          <li>
              <div class="comment">
                  <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                      <img class="avatar" alt="" src="img/avatars/avatar.jpg">
                  </div>
                  <div class="comment-block">
                      <div class="comment-arrow"></div>
                      <span class="comment-by">
                          <strong>John Doe</strong>
                          <span class="float-right">
                              <span> <a href="#"><i class="fas fa-reply"></i> Reply</a></span>
                          </span>
                      </span>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                      <span class="date float-right">January 12, 2020 at 1:38 pm</span>
                  </div>
              </div>
          </li>
      </ul>

  </div>
  <div class="post-block mt-5 post-leave-comment">
      <h4 class="mb-3">Leave a comment</h4>

      <form class="contact-form p-4 rounded bg-color-grey" action="php/contact-form.php" method="POST">
          <div class="p-2">
              <div class="form-row">
                  <div class="form-group col-lg-6">
                      <label class="required font-weight-bold text-dark">Full Name</label>
                      <input type="text" value="" data-msg-required="Please enter your name." maxlength="100"
                          class="form-control" name="name" required>
                  </div>
                  <div class="form-group col-lg-6">
                      <label class="required font-weight-bold text-dark">Email Address</label>
                      <input type="email" value="" data-msg-required="Please enter your email address."
                          data-msg-email="Please enter a valid email address." maxlength="100" class="form-control"
                          name="email" required>
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col">
                      <label class="required font-weight-bold text-dark">Comment</label>
                      <textarea maxlength="5000" data-msg-required="Please enter your message." rows="8"
                          class="form-control" name="message" required></textarea>
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col mb-0">
                      <input type="submit" value="Post Comment" class="btn btn-primary btn-modern"
                          data-loading-text="Loading...">
                  </div>
              </div>
          </div>
      </form>
  </div>