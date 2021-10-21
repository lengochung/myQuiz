<?php

    require '../helpers/require_for_requests_server.php';

    $conn = new Connect_MySql();

    $questions = $conn->load('questions');

    $ques = $questions->get_column_value_fetch('qid', $_GET['qid']);
?>

<div class="">
    <b>Câu <?php echo $_GET['num']; ?>:</b> <?php echo $ques['content']; ?>
    <form action="" method="post" class="" name="formques">
      <div class="float-right text-success"><small><i id="message_update_answer"></i></small></div>
        <fieldset class="ml-5 mt-2 mb-2">
          <div class="form-check">
              <label class="form-check-label">
              <input type="radio" class="form-check-input" name="answer" id="" value="A" <?php if($ques['answer']=='A') echo 'checked'; ?>>
              A. <?php echo $ques['a']; ?>
            </label>
          </div>
          <div class="form-check">
              <label class="form-check-label">
              <input type="radio" class="form-check-input" name="answer" id="" value="B" <?php if($ques['answer']=='B') echo 'checked'; ?>>
              B. <?php echo $ques['b']; ?>
            </label>
          </div>
          <div class="form-check">
              <label class="form-check-label">
              <input type="radio" class="form-check-input" name="answer" id="" value="C" <?php if($ques['answer']=='C') echo 'checked'; ?>>
              C. <?php echo $ques['c']; ?>
            </label>
          </div>
          <div class="form-check">
              <label class="form-check-label">
              <input type="radio" class="form-check-input" name="answer" id="" value="D" <?php if($ques['answer']=='D') echo 'checked'; ?>>
              D. <?php echo $ques['d']; ?>
            </label>
          </div>
        </fieldset>
        <?php if(c_assign()['mode']!=2): ?>
          <button type="button" onclick="update_answer(document.forms.formques, <?php echo $ques['qid']; ?>)" 
                class="btn btn-primary">Cập nhật đáp án</button>
        <?php endif; ?>
        
        <?php if(c_assign()['mode'] == 0): ?>
          <button type="submit" name="deletequestion" value="<?php echo $ques['qid']; ?>"
                           class="btn btn-danger">Xóa</button>
        <?php endif; ?>

      </form>

</div>
