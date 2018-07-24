#include <stdlib.h>
#include <conio.h>
#include <iostream.h>

class Estado{
	private:
   	 bool campesino;
	    bool zorro;
	    bool oca;
	    bool grano;
	public:
	    bool getCampesino();
	    bool getZorro();
	    bool getOca();
	    bool getGrano();
	    void setCampesino(bool c);
	    void setZorro(bool z);
	    void setOca(bool o);
	    void setGrano(bool g);
       char getC();
       bool estadoProhibido();
       Estado();
};

Estado::Estado(){
	campesino=NULL;
	zorro=NULL;
	oca=NULL;
	grano=NULL;
}

void Estado::setCampesino(bool c){
	campesino=c;
}

void Estado::setZorro(bool z){
	zorro=z;
}

void Estado::setOca(bool o){
	oca=o;
}

void Estado::setGrano(bool g){
	grano=g;
}

bool Estado::getCampesino(){
	return campesino;
	}

bool Estado::getZorro(){
	return zorro;
}

bool Estado::getOca(){
	return oca;
}

bool Estado::getGrano(){
	return grano;
}
char Estado::getC(){
if(campesino){return('A');}
else{return('L');}
}

bool Estado::estadoProhibido(){
	bool estado=0;
	if(zorro==oca && campesino!=zorro){
		estado=1;
	}else if(oca==grano && campesino!=oca){
			estado=1;
	}
	return estado;
}




class Nodo{
	private:
		Nodo *siguiente;
      Nodo *anterior;
      Nodo *derecha;
      Estado *info;
   public:
   	Nodo *getSiguiente();
      Nodo *getAnterior();
      Nodo *getDerecha();
      Estado *getInfo();
      void setInfo(Estado *est);
      void setSiguiente(Nodo *s);
      void setAnterior(Nodo *a);
      void setDerecha(Nodo *d);
      void visitar();
      Nodo();
};

void Nodo::visitar(){
	if(!NULL){
   	cout<<getInfo()->getC();
      cout<<getInfo()->getZorro();
      cout<<getInfo()->getOca();
      cout<<getInfo()->getGrano();
      cout<<" - ";;
      if(siguiente!=NULL)
      	siguiente->visitar();
      if(derecha!=NULL){
      	cout<<endl;cout<<"                                   ";
      	derecha->visitar();
      }
   }
}

Nodo::Nodo(){
	siguiente=NULL;
	anterior=NULL;
   derecha=NULL;
	info = new Estado();
}


void Nodo::setSiguiente(Nodo *s){
	siguiente=s;
}

void Nodo::setDerecha(Nodo *d){
   derecha=d;
}

void Nodo::setAnterior(Nodo *a){
	anterior=a;
}

void Nodo::setInfo(Estado *est){
info=est;
}

Estado *Nodo::getInfo(){
	return info;
}

Nodo *Nodo::getSiguiente(){
	return siguiente;
}

Nodo *Nodo::getDerecha(){
	return derecha;
}

Nodo *Nodo::getAnterior(){
	return anterior;
}


class Arbol{
	private:
		Nodo *NodoActual;
		Nodo *raiz;
      Nodo *atras;
	public:
		void setInicio(Nodo *i);
		void setFin(Nodo *f);
		Arbol();
		void insertarNodo(Nodo nodo);
		void crearArbol(bool &c,bool &z,bool &o,bool &g,int con,bool der);
		bool generarEstado(bool &c,bool &z,bool &o,bool &g,int con,Nodo *ind);
      bool estadoRepetido(Nodo *ind,bool c,bool z,bool o,bool g);
      void regresar();
      void imprimir();
};

void Arbol::imprimir(){
   raiz->visitar();
}

void Arbol::crearArbol(bool &c,bool &z,bool &o,bool &g,int cont, bool der){
	bool estado;
   if(cont==4){
   }else{
		while(generarEstado(c,z,o,g,cont,NodoActual)){
   		cont++;
   	}
   	Nodo *ptrNodo = new Nodo();
      Estado *est=new Estado();
      est->setCampesino(c);
      est->setZorro(z);
      est->setOca(o);
      est->setGrano(g);
   	ptrNodo->setInfo(est);
   	if(raiz == NULL){
   		raiz=ptrNodo;
      	NodoActual=raiz;
   	}else if(der!=1){
   			ptrNodo->setAnterior(NodoActual);
            NodoActual->setSiguiente(ptrNodo);
      		NodoActual=ptrNodo;
      	}else{
            ptrNodo->setAnterior(NodoActual);
            NodoActual->setDerecha(ptrNodo);
            NodoActual=ptrNodo;
      	}

   	if(ptrNodo->getInfo()->getCampesino()==0 && ptrNodo->getInfo()->getZorro()==0 && ptrNodo->getInfo()->getOca()==0 && ptrNodo->getInfo()->getGrano()==0){
         if(atras==NULL)
      		atras=ptrNodo->getAnterior();
   	}else if(ptrNodo->getAnterior()!=NULL){
      	if(estadoRepetido(NodoActual->getAnterior(),c,z,o,g)){
         	if(der==0){
      			Nodo *aux = new Nodo();
         		aux=ptrNodo;
         		ptrNodo=ptrNodo->getAnterior();
         		ptrNodo->setSiguiente(NULL);
         		NodoActual=ptrNodo;
         		delete aux;
         		crearArbol(c,z,o,g,++cont,0);
            }else{
            	Nodo *aux = new Nodo();
         			aux = ptrNodo;
         			ptrNodo=ptrNodo->getAnterior();
         			ptrNodo->setDerecha(NULL);
         			NodoActual=ptrNodo;
         			delete aux;
                  crearArbol(c,z,o,g,++cont,0);
            }
      	}else{
      		crearArbol(c,z,o,g,0,0);
      	}
   	}else{
   		crearArbol(c,z,o,g,0,0);
   	}
   }
}

void Arbol::regresar(){
   while(atras!=raiz){
   	NodoActual=atras;
      crearArbol(atras->getInfo()->getCampesino(),atras->getInfo()->getZorro(),atras->getInfo()->getOca(),atras->getInfo()->getGrano(),3,1);
      atras = atras->getAnterior();
   }
}

bool Arbol::estadoRepetido(Nodo *NodoActual,bool c,bool z,bool o,bool g){
	bool estado=0;
   while(NodoActual!=NULL){
   	if(NodoActual->getInfo()->getCampesino()==c)
      	if(NodoActual->getInfo()->getZorro()==z)
         	if(NodoActual->getInfo()->getOca()==o)
            	if(NodoActual->getInfo()->getGrano()==g){
               	estado=1;
               }
      NodoActual = NodoActual->getAnterior();
   }
   return estado;
}

bool Arbol::generarEstado(bool &c,bool &z,bool &o,bool &g,int con,Nodo *NodoActual){
	bool estado=0;
	bool aux1,aux2,aux3,aux4;

	aux1=c; aux2=z, aux3=o, aux4=g;
   if(z!=o && con==0){
   	if(c==1)
      	c=0;
      else
      	c=1;
   }else if(g!=o && con==0){
   	if(c==1)
      	c=0;
      else
      	c=1;
   }
	if(c==z && con==1){
		if(c==1){
			c=0;
			z=0;
		}else{
			c=1;
			z=1;
		}
	}
	if(c==o && con==2){
			if(c==1){
				c=0;
				o=0;
			}else{
				c=1;
				o=1;
			}
					}
	if(c==g && con==3){
			if(c==1){
				c=0;
				g=0;
			}else{
				c=1;
				g=1;
			}
		}
    if(con>=4){
    	estado=1;
    }else{
		Estado *auxEst=new Estado();
		auxEst->setCampesino(c);
		auxEst->setZorro(z);
		auxEst->setOca(o);
		auxEst->setGrano(g);
	 	estado=auxEst->estadoProhibido();
    	if(estado){
    		c=aux1;z=aux2;o=aux3;g=aux4;
    	}else if(NodoActual!=NULL)
    		if(NodoActual->getAnterior()!=NULL)
    			if(estadoRepetido(NodoActual->getAnterior(),c,z,o,g)){
     			c=aux1;z=aux2;o=aux3;g=aux4;
      		}
    }
	 return estado;
}



Arbol::Arbol(){
	NodoActual=NULL;
	raiz=NULL;
   atras = NULL;
}

void Arbol::insertarNodo(Nodo nodo){

}


void main(){
	clrscr();
   cout<<"----------------------PROGRAMA----------------"<<endl;
   cout<<"----------CAMPESINO, ZORRO, OCA Y GRANO-------"<<endl;
   cout<<"           LOS VALORES AQUI=1, ALLA=0"<<endl<<endl<<endl;

    cout<<"ESTADO INICIAL.............................ESTADO FINAL"<<endl;
    cout<<" "<<endl;
	Arbol *oArbol;
   oArbol=new Arbol();
   oArbol->crearArbol(true,true,true,true,0,0);
   oArbol->regresar();
   oArbol->imprimir();
   getch();
}
