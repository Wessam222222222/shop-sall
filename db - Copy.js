const mongoose = require('mongoose')

mongoose.connect('mongodb+srv://wessamahmedsamirahmed:tPHeVa9P9G4EKTT9@cluster0.7ohw8f8.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0')
.then(() =>{
    consol.log('connected to DB')
})
.catch(() =>{
    console.logzz('Unable to connected to BD')
})    