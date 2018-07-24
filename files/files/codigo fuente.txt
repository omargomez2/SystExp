package edad;

import java.time.LocalDate;
import java.time.Period;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Scanner;

public class Edad {

    public static void calcular(LocalDate fechaNac) {
        LocalDate ahora = LocalDate.now();
        Period periodo = Period.between(fechaNac, ahora);
        System.out.printf(" tiene: %s años, %s meses y %s días",
                periodo.getYears(), periodo.getMonths(), periodo.getDays());
    }
    
    class Persona {

    private String nombre;
    private LocalDate fecha;

    public Persona() {
    }

    public Persona(String nombre, LocalDate fecha) {
        this.nombre = nombre;
        this.fecha = fecha;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public LocalDate getFecha() {
        return fecha;
    }

    public void setFecha(LocalDate fecha) {
        this.fecha = fecha;
    }

}

    public static void main(String[] args) {
        ArrayList<Persona> personas = new ArrayList<Persona>();
        Scanner sn = new Scanner(System.in);
        boolean salir = false;
        int opcion;
        String nombre;
        String fecha;
        System.out.println("         Bienvenido");
        while (!salir) {
            System.out.println("          Menú");
            System.out.println("1. Agregar una persona");
            System.out.println("2. Calcular edad");
            System.out.println("3. Imprimir etapa del ciclo de vida");
            System.out.println("4. Salir");
            System.out.println("Escriba una de las opciones");
            opcion = sn.nextInt();
            switch (opcion) {
                case 1:
                    System.out.print("Nombre:");
                    nombre = sn.next();
                    System.out.println("Utilice el siguiente formato dd/MM/yyyy");
                    System.out.print("Fecha de nacimiento:");
                    fecha = sn.next();

                    DateTimeFormatter fmt = DateTimeFormatter.ofPattern("dd/MM/yyyy");
                    LocalDate fechaNac = LocalDate.parse(fecha, fmt);
                    if (fechaNac.isLocalDate()) {
                        personas.add(new Persona(nombre, fechaNac));
                        System.out.println("Persona Ingresada");
                    } else {
                        System.out.println("La fecha es inválida");
                    }
                    break;

                case 2:
                    System.out.println("Lista de personas y su edad");
                    for (Persona p : personas) {
                        System.out.println(p.getNombre() + "  ");
                        calcular(p.getFecha());
                    }
                    break;
                case 3:
                    System.out.println("Lista de personas");
                    for (Persona p : personas) {
                        System.out.println(p.getNombre() + "  ");
                    }
                    break;
                case 4:
                    salir = true;
                    break;
                default:
                    System.out.println("Elija una opcion solo del 1 al 4");
            }
        }
    }
}
