
// Pin est la led de l'Arduino pour les test de connexion
int pin = 13;
// Data est la valeur recue par le site web
int data;
// sending est la valeur renvoyé
int sendint;
String sendstr;
// SensorPin est la connexion du Thermometre
const int sensorPin = A0;

//configuration de Base
void setup() {
  
   //Commencer la Connexion en série pour le transfert de données
  Serial.begin(9600);
   //Configure le pin de la LED en sortie
  pinMode(pin, OUTPUT);

}

//Programme de l'Arduino
void loop() {
  
  // Création de la Température en °C
  int sensorVal = analogRead(sensorPin);
  float voltage = (sensorVal/1024.0) * 5.0;
  float temperature = (voltage - .5) * 100;
  
  // Lecture d'une commande sur le site web
  if(Serial.available() > 0){
    do{
        data = Serial.read(); //Removes the message from the serial cache
        
        switch(data){
          
            case 116:
                // La valeur renvoyé sera la valeur d la température
                sendint = temperature;
                sendstr = String(sendint);
                // On renvoie la sendstr
                Serial.print(sendstr); 
                delay(100); // Pause 100ms
                break;
                
            case 99:
                // La valeur renvoyé sera "YES"
                sendstr = "YES";
                digitalWrite(pin, HIGH); // LED ON
                delay(300); // Pause 300ms 
                digitalWrite(pin, LOW); //LED OFF
                delay(300); // Pause 300ms 
                digitalWrite(pin, HIGH); // LED ON
                delay(300); //Pause 300ms 
                digitalWrite(pin, LOW); // LED OFF
                delay(300); // Pause 300ms 
                digitalWrite(pin, HIGH); // LED ON
                delay(300); // Pause 300ms 
                digitalWrite(pin, LOW); // LED OFF
                // On renvoie la sendstr
                Serial.print(sendstr);
                delay(100); // Pause 100ms 
                break;
                
            default: 
            
                // On renvoie data recue par defaut
                Serial.print(data);
                delay(100); // Pause 100ms        
                break;            
        }    
    }while(Serial.available()>0);   
    
    // On envoie le symbole de fin d'écriture
    Serial.write('a');
  }
}
