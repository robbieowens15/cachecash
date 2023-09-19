cachecash
-- 
CS 4750 - Database Systems Final Project

**Purpose**: To create a Sports Betting Book (fake money called *cashcache* ;)) relying on a Relational Database Store
- Provides User Authentication and Profile Page customization
- Ability to place bets on provided games/leagues for *Moneyline*, *Spread*, *Over/Under*
- Ability to follow other users and view their bets
- **Admin** page to manage the games available for betting on
- Leverages *SQL Triggers* to automate pay outs and balancing the book when a bet is placed (pay-in) won/lost (pay-out)
- For user safety, *SQL Check* to user users are 21 years old or older
- In `*.php` code uses `prepare()`, `bindValue()`, and `execute()` to mitigate risk of SQL injection attacks

# Database Design
### Entity Relationship Diagram
**Games**: What can be bet on
**Bets**: A specific bet placed on a game for a specific line by a user
**Accounts**: Users or admin if the boolean field is true
**Posts**: Created by a user to share thoughts about current bets
**Comments**: How users react to each-others posts
**House**: Keeps the books balanced - is the clearing house for wagers and winnings

![](img/ERDiagram.jpeg?raw=true)

### Table Schema Statements
accounts(id, username, password, email, age, balance, admin)

friends(email_1, email_2)

games(game_id, league, home_team, away_team, homeSpread, awaySpread, over_under, homeMoneyline, awayMoneyline, game_date)

bets(bet_num, account_id, game_id, team, wager, bet_type:Enum, active:Binary, result)

house(account_id, bet_num, wager) 
N.B. [Used for accounting - completes flow of cacheCash through system]
One entry when bet is made [Pay_in] → sets wager to positive value as the money is now stored with the house; when bet settles [Pay_out], if bet_won is true sets wager to the negative value of payout from bets(bet_number, email)

pays_in(account_id, bet_num)

pays_out(account_id, bet_num, bet_won:Binary)

comments(comment_id, email, date_posted, comment_value)

post(email, comment_number)

# Run Locally

1. clone this repo
2. Setup Database with .sql files from this repo
3. modify `connect-db.php` for your new database
4. Place all php, css, img, etc. into htdocs (xmapp and run server)
