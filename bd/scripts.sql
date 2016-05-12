select * from evaluacion

CREATE FUNCTION calc_disponible() RETURNS TRIGGER AS $ControlDisponibilidad$
	BEGIN
		IF ((SELECT (disponibilidad) FROM evaluacion WHERE id_eval=NEW.id_eval)>0) THEN
		UPDATE objeto_a SET disponible = 'TRUE' WHERE id_obj = NEW.id_obj;
		ELSE
		UPDATE objeto_a SET disponible = 'FALSE' WHERE id_obj = NEW.id_obj;
		end if;
		RETURN NEW;
	END;
$ControlDisponibilidad$ LANGUAGE plpgsql;

CREATE TRIGGER ControlDisponibilidad after insert or update on evaluacion
	for each row execute procedure calc_disponible();
