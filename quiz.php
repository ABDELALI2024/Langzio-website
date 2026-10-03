<?php
require_once __DIR__ . "/classes/Auth.php";
Auth::requireLogin();
$subStatus = Auth::subscriptionStatus();
$pageTitle = "Darija Quiz — Langzio";
$pageDescription = "Practice everyday Moroccan Darija with a quick interactive quiz.";
$pageClass = "app-page quiz-page";
include "includes/head.php";
?>
<style>
.quiz-hero{display:flex;justify-content:space-between;gap:24px;align-items:flex-start;margin-bottom:22px}.quiz-kicker{color:var(--green-2);font-size:.78rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase;margin:0 0 8px}.quiz-hero h1{margin:0 0 8px}.quiz-hero p{margin:0;color:var(--muted);max-width:620px;line-height:1.6}.quiz-score{min-width:112px;padding:14px 16px;border:1px solid rgba(0,211,139,.25);background:rgba(0,211,139,.08);border-radius:14px;text-align:center}.quiz-score strong{display:block;font-size:1.6rem;color:var(--green-2)}.quiz-progress{height:8px;background:rgba(255,255,255,.1);border-radius:99px;overflow:hidden;margin:0 0 24px}.quiz-progress span{display:block;height:100%;width:0;background:linear-gradient(90deg,var(--green-2),#8af5c9);border-radius:inherit;transition:width .25s ease}.quiz-card{max-width:760px}.quiz-meta{display:flex;justify-content:space-between;color:var(--muted);font-size:.88rem;margin-bottom:18px}.quiz-question{font-size:clamp(1.25rem,2vw,1.7rem);line-height:1.35;margin:0 0 22px}.quiz-options{display:grid;gap:12px}.quiz-option{display:flex;align-items:center;gap:12px;width:100%;padding:15px 16px;text-align:left;border:1px solid rgba(255,255,255,.12);border-radius:12px;background:rgba(255,255,255,.04);color:inherit;font:inherit;cursor:pointer;transition:border-color .2s,background .2s,transform .2s}.quiz-option:hover,.quiz-option:focus-visible{border-color:var(--green-2);background:rgba(0,211,139,.09);transform:translateY(-1px);outline:none}.quiz-option[aria-pressed=true]{border-color:var(--green-2);background:rgba(0,211,139,.14)}.option-letter{display:grid;place-items:center;width:30px;height:30px;flex:0 0 30px;border-radius:50%;background:rgba(255,255,255,.1);font-weight:800;color:var(--green-2)}.quiz-feedback{min-height:28px;margin:18px 0 0;font-weight:700}.quiz-feedback.correct{color:#83efbd}.quiz-feedback.wrong{color:#ffadad}.quiz-actions{display:flex;justify-content:flex-end;gap:12px;margin-top:22px}.quiz-result{display:none;text-align:center;max-width:620px}.quiz-result.is-visible{display:block}.quiz-result h2{margin-top:0}.result-score{font-size:3rem;font-weight:800;color:var(--green-2);margin:16px 0}.quiz-tip{color:var(--muted);line-height:1.6}.quiz-card.is-finished .quiz-body{display:none}@media(max-width:680px){.quiz-hero{display:block}.quiz-score{margin-top:18px;width:max-content}.quiz-actions{justify-content:stretch}.quiz-actions .btn{flex:1}}
</style>
<div class="app-shell container">
    <aside class="sidebar glass">
        <a class="brand" href="index.php">Langzio</a>
        <button class="nav-toggle" id="navToggle" type="button" aria-label="Toggle navigation">☰</button>
        <nav class="side-nav" aria-label="Main navigation">
            <a href="dashboard.php">Dashboard</a><a href="translator.php">Translator</a><a href="chat.php">AI Chat</a><a href="quiz.php" aria-current="page">Quiz</a><a href="guides.php">Guides</a><a href="kids.php">Kids</a><a href="blog.php">Blog</a>
            <hr style="border-color:rgba(255,255,255,0.08);margin:12px 0"><a href="profile.php">Profile</a><a href="pricing.php">Pricing</a><a href="logout.php">Log out</a>
        </nav>
        <div style="margin-top:auto;padding:12px;border-radius:10px;background:rgba(0,211,139,0.08);font-size:.85rem;text-align:center"><?php if ($subStatus["is_subscribed"]): ?><strong>Pro</strong> — Active<?php else: ?><a href="pricing.php" style="color:var(--green-2)">Upgrade to Pro</a><?php endif; ?></div>
    </aside>
    <main class="app-content">
        <div class="quiz-hero"><div><p class="quiz-kicker">Practice lab</p><h1>How well do you know Darija?</h1><p>Choose the best answer, learn the context, and build confidence one phrase at a time.</p></div><div class="quiz-score" aria-live="polite"><strong id="scoreValue">0</strong><span>points</span></div></div>
        <section class="card quiz-card" aria-labelledby="quizHeading">
            <div class="quiz-body">
                <div class="quiz-progress" aria-label="Quiz progress"><span id="progressBar"></span></div>
                <div class="quiz-meta"><span id="questionCount">Question 1 of 6</span><span id="categoryLabel">Basics</span></div>
                <h2 class="quiz-question" id="quizHeading"></h2>
                <div class="quiz-options" id="quizOptions" role="group" aria-label="Answer choices"></div>
                <p class="quiz-feedback" id="quizFeedback" aria-live="polite"></p>
                <div class="quiz-actions"><button class="btn btn-primary" id="nextButton" type="button" disabled>Check answer</button></div>
            </div>
            <div class="quiz-result" id="quizResult" aria-live="polite"><p class="quiz-kicker">Quiz complete</p><h2 id="resultHeading"></h2><div class="result-score" id="resultScore"></div><p class="quiz-tip" id="resultTip"></p><button class="btn btn-primary" id="restartButton" type="button">Try again</button></div>
        </section>
    </main>
</div>
<script>
(function(){
    const questions=[
        {category:'Basics',question:'What does “Kidayr?” mean when speaking to a man?',answers:['Where are you going?','How are you?','What are you buying?','Are you hungry?'],correct:1,explanation:'Kidayr? is a friendly “How are you?” for a man. For a woman, say Kidayra?'},
        {category:'Politeness',question:'Which word softens a request like “Bghit atay”?',answers:['Safi','3afak','Bzzaf','Fin'],correct:1,explanation:'Add 3afak (“please”) to make requests warmer and more polite.'},
        {category:'Restaurant',question:'“Salam, wach kayn blassa?” is useful when you want to…',answers:['Ask if a table is available','Ask for the bill','Order a taxi','Say goodbye'],correct:0,explanation:'It means “Hello, is there a table available?”'},
        {category:'Souk',question:'What does “Ghaliya chwiya” mean?',answers:['It is very fresh','It is a little expensive','I will come tomorrow','That is perfect'],correct:1,explanation:'Use it when bargaining: “It is a bit expensive.”'},
        {category:'Basics',question:'Which phrase means “Thank you very much”?',answers:['Shukran bzzaf','Labas?','Bslama','Shno hadchi?'],correct:0,explanation:'Shukran bzzaf expresses warm gratitude.'},
        {category:'Souk',question:'“Safi, ntafa9na” means…',answers:['Please repeat','I do not understand','Great, we have a deal','Where is the market?'],correct:2,explanation:'Safi, ntafa9na is a friendly way to close a bargain: “Great, we have a deal.”'}
    ];
    let index=0,score=0,selected=null,answered=false;
    const $=id=>document.getElementById(id), question=$('quizHeading'), options=$('quizOptions'), feedback=$('quizFeedback'), next=$('nextButton');
    function render(){const item=questions[index];selected=null;answered=false;question.textContent=item.question;$('questionCount').textContent='Question '+(index+1)+' of '+questions.length;$('categoryLabel').textContent=item.category;$('progressBar').style.width=((index/questions.length)*100)+'%';feedback.textContent='';feedback.className='quiz-feedback';next.textContent='Check answer';next.disabled=true;options.innerHTML='';item.answers.forEach((answer,i)=>{const button=document.createElement('button');button.type='button';button.className='quiz-option';button.setAttribute('aria-pressed','false');button.innerHTML='<span class="option-letter">'+String.fromCharCode(65+i)+'</span><span>'+answer+'</span>';button.addEventListener('click',()=>{if(answered)return;selected=i;options.querySelectorAll('.quiz-option').forEach(option=>option.setAttribute('aria-pressed','false'));button.setAttribute('aria-pressed','true');next.disabled=false;});options.appendChild(button);});}
    next.addEventListener('click',()=>{if(selected===null)return;if(!answered){answered=true;const item=questions[index],isCorrect=selected===item.correct;if(isCorrect){score++;$('scoreValue').textContent=score;feedback.textContent='Correct. '+item.explanation;feedback.className='quiz-feedback correct';}else{feedback.textContent='Not quite. '+item.explanation;feedback.className='quiz-feedback wrong';}options.querySelectorAll('.quiz-option').forEach((option,i)=>{option.disabled=true;if(i===item.correct)option.setAttribute('aria-pressed','true');});next.textContent=index===questions.length-1?'See result':'Next question';return;}if(index<questions.length-1){index++;render();}else{showResult();}});
    function showResult(){ $('progressBar').style.width='100%';$('resultHeading').textContent=score===questions.length?'Mzyan! Perfect score.':score>=4?'Bsa7tek! Strong work.':'Good start — keep practicing.';$('resultScore').textContent=score+' / '+questions.length;$('resultTip').textContent=score>=4?'You are ready to use these phrases in a real conversation.':'Review the phrases in the translator and try the quiz again to make them stick.';$('quizResult').classList.add('is-visible');document.querySelector('.quiz-card').classList.add('is-finished');}
    $('restartButton').addEventListener('click',()=>{index=0;score=0;$('scoreValue').textContent='0';$('quizResult').classList.remove('is-visible');document.querySelector('.quiz-card').classList.remove('is-finished');render();});
    render();
})();
</script>
<?php include "includes/footer.php"; ?>
