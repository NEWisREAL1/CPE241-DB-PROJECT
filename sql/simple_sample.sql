--
-- Dumping data for table `aircraft`
--

INSERT INTO `aircraft` (`aircraftID`, `owner_AirlineCode`, `aircraftModel`, `aircraftFCap`, `aircraftCCap`, `aircraftYCap`, `aircraftWCap`) VALUES
('A350-0', 'POY', 'A350-900', 450, 150, 100, 100),
('ALP', 'RTA', 'APOLLO-64bits', 1, 0, 0, 1),
('BOE001', 'EBD', 'boeing888', 50, 20, 20, 0),
('BOE002', 'EBD', 'boeing888', 50, 20, 20, 0),
('BOE003', 'EBD', 'boeing888', 50, 20, 20, 0),
('HERIx1', 'RTA', 'HERICARRIER', 0, 0, 0, 800),
('HERIx2', 'RTA', 'HERICARRIER', 0, 0, 0, 800),
('SUK01', 'POY', 'sukhothai-800', 100, 20, 20, 10),
('SUK02', 'POY', 'sukhothai-800', 100, 20, 20, 10),
('SUK03', 'EBD', 'sukhothai-800', 1, 0, 0, 1);

--
-- Dumping data for table `airline`
--

INSERT INTO `airline` (`airlineCode`, `airlineName`) VALUES
('EBD', 'Elbunokudai Airway'),
('POY', 'Poysian Air'),
('RTA', 'Royal Tuai Airforce');

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`airportCode`, `airportName`, `airport_country`, `airport_city`, `airport_timezone`) VALUES
('BKK', 'Suvarnabhumi International Airport', 'Thailand', 'Samut Prakan', 'ASIA/BANGKOK'),
('POYA', 'Poysian International Airport', 'United States', 'Icheon', 'USA');

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingId`, `uuid`, `numAdultPassenger`, `numChildrenPassenger`, `numInfantPassenger`) VALUES
('A1', 'c972817e-f148-45d9-8bbe-ae5610008418', 2, 0, 0),
('A2', 'c972817e-f148-45d9-8bbe-ae5610008418', 1, 0, 0),
('A3', 'd27350fa-80fd-41b6-a1ef-b3e72cd19e01', 1, 0, 0);

--
-- Dumping data for table `booking_flight`
--

INSERT INTO `booking_flight` (`bookingId`, `flightNum`) VALUES
('A1', 'FL01'),
('A2', 'FL02'),
('A3', 'FL02');

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`flightNum`, `airlineCode`, `aircraftID`, `depart_AirportCode`, `arrive_AirportCode`, `availableSeats`, `departureTime`, `arrivalTime`) VALUES
('FL01', 'POY', 'SUK01', 'BKK', 'POYA', 150, '2025-12-30 01:30:00', '2025-12-30 12:45:00'),
('FL02', 'EBD', 'BOE001', 'POYA', 'BKK', 90, '2026-01-04 09:00:00', '2026-01-04 16:00:00');

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`passportNum`, `passportCountry`, `passportExpireDate`, `firstName`, `lastName`, `DoB`, `nationality`, `user_uuid`) VALUES
('A000000', 'India', '2028-12-31', 'John', 'Doe', '1970-01-01 08:00:00', 'Indian', 'c972817e-f148-45d9-8bbe-ae5610008418'),
('A000001', 'Thailand', '2027-09-16', 'Taxi', 'Mini', '1999-09-09 09:09:09', 'Thai', 'd27350fa-80fd-41b6-a1ef-b3e72cd19e01'),
('FA12345', 'India', '2028-12-31', 'Jane', 'Doe', '1970-01-01 09:00:00', 'Indian', 'c972817e-f148-45d9-8bbe-ae5610008418');

--
-- Dumping data for table `passenger_booking`
--

INSERT INTO `passenger_booking` (`bookingId`, `passportNum`) VALUES
('A1', 'A000000'),
('A2', 'A000000'),
('A3', 'A000001'),
('A1', 'FA12345');

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentCode`, `bookingId`, `paymentAmount`, `paymentMethod`, `paymentDate`) VALUES
(1, 'A1', 15000, 'credit', '2025-11-11 11:30:12'),
(2, 'A2', 7500, 'credit', '2025-11-29 14:01:51'),
(3, 'A3', 32000, 'credit', '2025-10-01 20:19:46');

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`seatNum`, `class`, `flightNum`, `price`, `reserved`, `feature`) VALUES
('A001', 'W', 'FL01', 120, 'YES', '{temp feature}'),
('A001', 'C', 'FL02', 150, 'NO', '{temp feature}'),
('A002', 'W', 'FL01', 120, 'YES', '{temp feature}'),
('A002', 'C', 'FL02', 150, 'NO', '{temp feature}'),
('A003', 'W', 'FL01', 120, 'NO', '{temp feature}'),
('A003', 'C', 'FL02', 100, 'YES', '{temp feature}'),
('A004', 'C', 'FL02', 100, 'YES', '{temp feature}'),
('B001', 'W', 'FL01', 100, 'NO', '{temp feature}'),
('B002', 'W', 'FL01', 100, 'NO', '{temp feature}');

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticketNum`, `bookingId`, `flightNum`, `passportNum`, `seatNum`) VALUES
('FL01-1', 'A1', 'FL01', 'A000000', 'A001'),
('FL01-2', 'A1', 'FL01', 'FA12345', 'A002'),
('FL02-1', 'A2', 'FL02', 'A000000', 'A004'),
('FL02-2', 'A3', 'FL02', 'A000001', 'A003');

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uuid`, `password`, `firstname`, `lastname`, `email`, `phone`, `register_date`) VALUES
('c972817e-f148-45d9-8bbe-ae5610008418', '17b923c907f6c4$5d863b1ffa38', 'John', 'Doe', 'john@fakemail.com', NULL, '2024-03-08 14:56:10'),
('d27350fa-80fd-41b6-a1ef-b3e72cd19e01', 'asld1212$qwsdcfgy78901', 'Taxi', 'Mini', 'taximini@fakemail.com', '0877777777', '2025-01-08 14:56:10');
