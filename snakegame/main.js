const test_name = 'AAA';
const test_score = 25000;

fetch('assets/php/set_highscore.php', {
  method: 'POST',
  mode: 'same-origin',
  credentials: 'same-origin',
  headers: {
    Accept: 'application/json, text/plain, */*',
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({ name: test_name, score: test_score }),
})
  .then((response) => response.json())
  .then((data) => {
    console.log('Success: ', data);
    return data;
  });
  <div id="testing_score_features" style="color:white;">
    <br />
    <div>
      <label for="score">Name:</label>
      <input type="text" id="name-input" style="width:200px;">
    </div>
    <br />
    <div>
      <label for="score">Score:</label>
      <input type="number" id="score-input" style="width:200px;">
    </div>
    <br />
    <div>
      <button id="add-score-btn">Add Score</button>
    </div>
    <br />
    <hr />
    <br />
    <div id="scores"></div><br />
    <button id="get-scores-btn">Get Highscores</button>
  </div>