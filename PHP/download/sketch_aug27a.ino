int kpin=2;
int xpin=A1;
int ypin=A2;

int led1=6;
int led2=7;
int led3=8;
int led4=9;

void setup() {
  pinMode(kpin, INPUT);
  pinMode(led1, OUTPUT);
  pinMode(led2, OUTPUT);
  pinMode(led3, OUTPUT);
  pinMode(led4, OUTPUT);

  digitalWrite(kpin, HIGH);
  Serial.begin(9600);
}

void loop() {
  int sw=digitalRead(kpin);
  int x=analogRead(xpin);
  int y=analogRead(ypin);

  Serial.print("Button : ");
  Serial.println(sw);
  Serial.print("X-area : ");
  Serial.println(x);
  Serial.print("Y-area : ");
  Serial.println(y);

  digitalWrite(led1, LOW);
  digitalWrite(led2, LOW);
  digitalWrite(led3, LOW);
  digitalWrite(led4, LOW);

  if(sw==0) {
    digitalWrite(led1, HIGH);
    digitalWrite(led2, HIGH);
    digitalWrite(led3, HIGH);
    digitalWrite(led4, HIGH);
  }
  else if(x>1000&&y>1000) {
    digitalWrite(led1, HIGH);
    digitalWrite(led2, HIGH);
    digitalWrite(led3, HIGH);
    digitalWrite(led4, HIGH);  
  }
  else if(y==0) {
    digitalWrite(led1, HIGH);
  }
  else if( y>1000) {
    digitalWrite(led2, HIGH);
  }
  else if(x==0) {
    digitalWrite(led3, HIGH);
  }
  else if(x>1000) {
    digitalWrite(led4, HIGH);
  }
  delay(500);
}
