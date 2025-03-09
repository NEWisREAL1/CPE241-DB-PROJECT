-- Adding more airlines
INSERT INTO `airline` (`airlineCode`, `airlineName`) VALUES
('SKY', 'Skyward Airlines'),
('VTX', 'Vortex Air'),
('ORB', 'Orbital Airways'),
('ZEN', 'Zenith Aviation');

-- Adding more airports
INSERT INTO `airport` (`airportCode`, `airportName`, `airport_country`, `airport_city`, `airport_timezone`) VALUES
('ZEN', 'Tokyo Haneda Airport', 'Japan', 'Tokyo', 'Asia/Tokyo'),
('MOVA', 'Frankfurt Airport', 'Germany', 'Frankfurt', 'Europe/Berlin'),
('LYRA', 'John F. Kennedy International Airport', 'United States', 'New York', 'America/New_York'),
('TARO', 'Sydney Kingsford Smith Airport', 'Australia', 'Sydney', 'Australia/Sydney');

-- Adding more aircraft
INSERT INTO `aircraft` (`aircraftID`, `owner_AirlineCode`, `aircraftModel`, `aircraftFCap`, `aircraftCCap`, `aircraftYCap`, `aircraftWCap`) VALUES
('AIR120', 'SKY', 'Skyjet-200', 60, 40, 200, 20),
('AIR203', 'SKY', 'SkyLiner-750', 80, 60, 250, 30),
('AIR808', 'POY', 'SkyPhoenix-500', 120, 50, 180, 20),
('AIR909', 'SKY', 'SkyEagle-900', 100, 50, 220, 30),
('BOE444', 'EBD', 'Boeing747-Advanced', 100, 50, 250, 50),
('BOE555', 'EBD', 'BoeingSuperMax', 150, 60, 300, 50),
('BOE777', 'EBD', 'BoeingX-777', 120, 80, 280, 40),
('JET500', 'VTX', 'Jetstream-500', 90, 40, 180, 20),
('JET505', 'VTX', 'Jetstream-505X', 95, 50, 190, 25),
('JET888', 'VTX', 'JetGlider-888', 110, 70, 220, 30),
('JET900', 'VTX', 'Vortex-900X', 130, 80, 250, 40),
('MIL111', 'RTA', 'MilitaryCobra-X', 0, 0, 0, 200),
('SUK22', 'ORB', 'Sukhothai-22X', 100, 40, 160, 20),
('SUK777', 'ORB', 'Orbital-777', 110, 60, 200, 30),
('SUK321', 'ORB', 'OrbitalExpress-321', 120, 70, 220, 40);

-- Adding more flights
INSERT INTO `flight` (`flightNum`, `airlineCode`, `aircraftID`, `depart_AirportCode`, `arrive_AirportCode`, `availableSeats`, `departureTime`, `arrivalTime`) VALUES
('FL03', 'SKY', 'AIR203', 'ZEN', 'MOVA', 180, '2025-12-31 06:15:00', '2025-12-31 12:30:00'),
('FL04', 'VTX', 'JET500', 'MOVA', 'ZEN', 120, '2026-01-02 14:45:00', '2026-01-02 20:00:00'),
('FL05', 'ORB', 'SUK03', 'BKK', 'LYRA', 200, '2026-01-05 08:00:00', '2026-01-05 14:15:00'),
('FL06', 'EBD', 'BOE777', 'LYRA', 'BKK', 95, '2026-01-07 10:30:00', '2026-01-07 17:30:00'),
('FL07', 'POY', 'A350-0', 'TARO', 'MOVA', 140, '2026-01-09 13:00:00', '2026-01-09 19:45:00'),
('FL08', 'VTX', 'JET888', 'MOVA', 'TARO', 160, '2026-01-12 07:30:00', '2026-01-12 13:00:00'),
('FL09', 'ORB', 'SUK22', 'ZEN', 'BKK', 175, '2026-01-15 11:45:00', '2026-01-15 18:30:00'),
('FL10', 'EBD', 'BOE002', 'BKK', 'ZEN', 100, '2026-01-18 15:00:00', '2026-01-18 21:45:00'),
('FL11', 'SKY', 'AIR120', 'ZEN', 'MOVA', 190, '2026-01-20 05:45:00', '2026-01-20 12:00:00'),
('FL12', 'VTX', 'JET505', 'MOVA', 'ZEN', 135, '2026-01-22 13:30:00', '2026-01-22 19:15:00'),
('FL13', 'ORB', 'SUK777', 'LYRA', 'BKK', 220, '2026-01-24 07:00:00', '2026-01-24 14:00:00'),
('FL14', 'EBD', 'BOE444', 'BKK', 'LYRA', 110, '2026-01-26 09:30:00', '2026-01-26 16:45:00'),
('FL15', 'POY', 'AIR808', 'TARO', 'MOVA', 160, '2026-01-28 12:00:00', '2026-01-28 18:30:00'),
('FL16', 'VTX', 'JET900', 'MOVA', 'TARO', 180, '2026-01-30 06:15:00', '2026-01-30 11:45:00'),
('FL17', 'ORB', 'SUK321', 'ZEN', 'BKK', 150, '2026-02-01 15:30:00', '2026-02-01 22:15:00'),
('FL18', 'EBD', 'BOE555', 'BKK', 'ZEN', 105, '2026-02-03 08:00:00', '2026-02-03 14:30:00'),
('FL19', 'SKY', 'AIR909', 'LYRA', 'TARO', 175, '2026-02-05 10:45:00', '2026-02-05 18:00:00'),
('FL20', 'RTA', 'MIL111', 'TARO', 'ZEN', 200, '2026-02-07 07:30:00', '2026-02-07 14:45:00');

INSERT INTO `booking` (`bookingId`, `uuid`, `numAdultPassenger`, `numChildrenPassenger`, `numInfantPassenger`, `bookingDate`) VALUES
('T1', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-01 00:00:00'),
('T2', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-04 00:00:00'),
('T3', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-31 00:00:00'),
('T4', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-10 00:00:00'),
('T5', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-11 00:00:00'),
('T6', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-15 00:00:00'),
('T7', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-02 00:00:00'),
('T8', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-31 00:00:00'),
('T9', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-30 00:00:00'),
('T10', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-02 00:00:00'),
('T11', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-01 00:00:00'),
('T12', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-02 00:00:00'),
('T13', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-16 00:00:00'),
('T14', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-19 00:00:00'),
('T15', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-20 00:00:00'),
('T16', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-20 00:00:00'),
('T17', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-09 00:00:00'),
('T18', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-12 00:00:00'),
('T19', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-13 00:00:00'),
('T20', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-31 00:00:00'),
('T21', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-06 00:00:00'),
('T22', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-31 00:00:00'),
('T23', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-01 00:00:00'),
('T24', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-02 00:00:00'),
('T25', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-03 00:00:00'),
('T26', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0, '2025-03-09 00:00:00');